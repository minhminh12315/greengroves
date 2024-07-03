<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Categories;
use Illuminate\Support\Facades\Log;

class Header extends Component
{
    public $categories;
    public $subcategories = [];
    public $selectedCategories = [];

    public function mount()
    {
        $this->categories = Categories::whereNull('parent_id')->get();
    }

    public function selectCategory($categoryId, $level)
    {
        // Nếu chọn category cấp 0
        if ($level == 0) {
            // Xóa tất cả lựa chọn và subcategories hiện tại
            $this->selectedCategories = [];
            $this->subcategories = [];

            // Lưu category cấp 0 được chọn và lấy subcategories của nó
            $this->selectedCategories[$level] = $categoryId;
            $this->subcategories[$level + 1] = Categories::where('parent_id', $categoryId)->get();
        } else {
            // Nếu đang chọn category cấp cao hơn (level > 0)
            if (isset($this->selectedCategories[$level]) && $this->selectedCategories[$level] == $categoryId) {
                // Nếu đang chọn lại category hiện tại, thì hủy lựa chọn và xóa các subcategory sâu hơn
                unset($this->selectedCategories[$level]);
                foreach ($this->subcategories as $key => $subcategory) {
                    if ($key > $level) {
                        unset($this->subcategories[$key]);
                    }
                }
                
            } else {
                // Chọn category mới
                $this->selectedCategories[$level] = $categoryId;

                // Lấy subcategories của category mới được chọn
                $subcategories = Categories::where('parent_id', $categoryId)->get();

                // Kiểm tra nếu có subcategories thì lưu vào subcategories[$level + 1]
                if ($subcategories->count() > 0) {
                    $this->subcategories[$level + 1] = $subcategories;
                } else {
                    // Nếu không có subcategories, xóa các subcategories ở cấp độ sâu hơn
                    for ($i = $level + 1; $i <= count($this->subcategories); $i++) {
                        unset($this->selectedCategories[$i]);
                        unset($this->subcategories[$i]);
                    }
                }
            }
        }
    }



    public function clearMenu()
    {
        $this->selectedCategories = [];
        $this->subcategories = [];
    }
    public function render()
    {
        return view('livewire.user.header');
    }
}
