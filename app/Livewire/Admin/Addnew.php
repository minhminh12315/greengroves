<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SubVariant;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Addnew extends Component
{
    use WithFileUploads;
    public $name;
    public $description;
    public $category_id;
    public $images;
    public $category_addnew;
    public $parent_id;
    public $variantNames = [];
    public $values = [];
    public $quantities = [];
    public $prices = [];
    public $combinations = [];
    public $product_type = 'single';
    public $variant_addnew;
    public $VariantAttributeModal = false;
    public $VariantOptionModal = false;
    public $addCategoryModal = false;
    public $newVariantName;
    public $quantity_single;
    public $price_single;
    public $variants = [];
    public $variantOptions = [];
    public $numberOfVariantOptions = 1;
    public $variantAttributes = [];
    public $variantCombinations = [];
    public $numberOfVariants = 1;
    public $newVariantOption;
    public $attribute_option = [];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:6|max:20',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.min' => 'Tên phải có ít nhất 6 ký tự.',
            'name.max' => 'Tên không được vượt quá 20 ký tự.',
            'images.required' => 'Bạn chưa chọn hình ảnh.',
            'images.*.image' => 'Tệp bạn chọn không phải là hình ảnh.',
            'images.*.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif, svg, webp.',
        ]);
    }

    public function render()
    {
        $data = [
            'category' => Categories::all(),
            'categories' => Categories::all(),
            'variants_display' => Variant::all(),
            'variant_options_display' => VariantOption::all(),
        ];
        return view('livewire.admin.addnew', $data);
    }

    public function mount()
    {
        $this->category_id = 1; // Set default value to the first category's ID
    }
    public function addVariantAttribute()
    {
        $this->variantAttributes[] = ['variant' => '', 'options' => ['']];
    }

    public function addVariantOption($index)
    {
        $this->variantAttributes[$index]['options'][] = '';
    }
    public function setProductType($type)
    {
        $this->product_type = $type;
    }

    public function deleteAttribute($attributeIndex)
    {
        // Xóa thuộc tính biến thể và tất cả các tùy chọn của nó từ mảng $variantAttributes
        unset($this->variantAttributes[$attributeIndex]);

        // Cập nhật lại kết hợp sau khi xóa
        $this->generateCombinations();
    }

    public function deleteOption($attributeIndex, $optionIndex)
    {
        // Xóa tùy chọn tương ứng từ mảng $variantAttributes
        unset($this->variantAttributes[$attributeIndex]['options'][$optionIndex]);

        // Cập nhật lại kết hợp sau khi xóa
        $this->generateCombinations();
    }

    public function generateCombinations()
    {
        $this->variantCombinations = [];

        // Lặp qua từng thuộc tính biến thể
        foreach ($this->variantAttributes as $attribute) {
            $options = $attribute['options'];
            $attributeName = Variant::find($attribute['variant'])->name; // Lấy tên của thuộc tính từ ID

            // Nếu không có tùy chọn, bỏ qua
            if (empty($options)) {
                continue;
            }

            // Tạo các kết hợp từ các tùy chọn của thuộc tính hiện tại
            $tempCombinations = [];
            foreach ($options as $option) {
                $combination = [
                    'variant' => $attributeName,
                    'option' => $option,
                    'quantity' => null, // Thay bằng giá trị mặc định hoặc để trống
                    'price' => null,    // Thay bằng giá trị mặc định hoặc để trống
                ];
                $tempCombinations[] = $combination;
            }

            // Kết hợp các kết hợp hiện có với các kết hợp mới
            if (empty($this->variantCombinations)) {
                $this->variantCombinations = $tempCombinations;
            } else {
                $newCombinations = [];
                foreach ($this->variantCombinations as $existingCombination) {
                    foreach ($tempCombinations as $newCombination) {
                        $newCombinations[] = [
                            'variant' => $existingCombination['variant'] . ' - ' . $newCombination['variant'],
                            'option' => $existingCombination['option'] . ' - ' . $newCombination['option'],
                            'quantity' => null, // Thay bằng giá trị mặc định hoặc để trống
                            'price' => null,    // Thay bằng giá trị mặc định hoặc để trống
                        ];
                    }
                }
                $this->variantCombinations = $newCombinations;
            }
        }
    }

    public function store_product()
    {
        $this->validate([
            'name' => 'required|min:6|max:20',
            'description' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'quantity_single' => 'required_if:product_type,single',
            'price_single' => 'required_if:product_type,single',
            'variantAttributes.*.options.*' => 'required_if:product_type,variable',
            'variantAttributes.*.variant' => 'required_if:product_type,variable',
            'variantCombinations.*.quantity' => 'required_if:product_type,variable',
            'variantCombinations.*.price' => 'required_if:product_type,variable',
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.min' => 'Tên phải có ít nhất 6 ký tự.',
            'name.max' => 'Tên không được vượt quá 20 ký tự.',
            'description.required' => 'Mô tả là bắt buộc.',
            'images.required' => 'Bạn chưa chọn hình ảnh.',
            'images.*.image' => 'Tệp bạn chọn không phải là hình ảnh.',
            'images.*.mimes' => 'Hình ảnh phải thuộc định dạng: jpeg, png, jpg, gif, svg, webp.',
        ]);
        try {
            
            $this->variantNames = [];
            $this->values = [];
            $this->quantities = [];
            $this->prices = [];


            // Tạo mới một sản phẩm
            $product = new Product();
            $product->name = $this->name;
            $product->description = $this->description;
            $product->category_id = $this->category_id;
            $product->type = $this->product_type;
            $product->save();


            // Reset các thuộc tính sau khi lưu sản phẩm
            $this->name = '';
            $this->description = '';
            $this->category_id = '';

            // Lưu ảnh sản phẩm
            foreach ($this->images as $image) {
                // Tạo tên file duy nhất bằng cách sử dụng thời gian hiện tại và tên gốc của file
                $imageName = time() . '_' . $image->getClientOriginalName();
                Log::info('Processing image', ['image' => $imageName]);
                
                // Lưu ảnh vào thư mục public/images
                $imagePath = $image->storeAs('public/assets/images', $imageName);
                Log::info('Image moved', ['image' => $imagePath]);
            
                // Tạo đường dẫn công khai cho ảnh
                $publicPath = 'assets/images/' . $imageName;
                Log::info('Image path', ['path' => $publicPath]);
            
                // Lưu thông tin ảnh vào cơ sở dữ liệu
                ProductImage::create([
                    'path' => $publicPath,
                    'product_id' => $product->id,
                ]);
                Log::info('Image uploaded', ['path' => $publicPath, 'product_id' => $product->id]);
            }

            // Xử lý sản phẩm loại 'single'
            if ($this->product_type == 'single') {

                ProductVariant::create([
                    'product_id' => $product->id,
                    'quantity' => $this->quantity_single,
                    'price' => $this->price_single,
                ]);

                
            }
            // Xử lý sản phẩm loại 'variable'
            else if ($this->product_type == 'variable') {

                // Kiểm tra $this->variantAttributes có phải là mảng
                if (is_array($this->variantAttributes)) {
                    foreach ($this->variantAttributes as $attribute) {

                        // Kiểm tra 'options' có phải là mảng
                        if (isset($attribute['options']) && is_array($attribute['options'])) {
                            $this->attribute_option = $attribute['options'];
                            foreach ($this->attribute_option as $op) {
                                Log::info('Processing option', ['option' => $op]);
                                $existingOption = VariantOption::where('name', $op)->first();

                                if (!$existingOption) {
                                    Log::info('Creating new VariantOption', ['variant_id' => $attribute['variant'], 'name' => $op]);
                                    // Nếu không tồn tại, tạo mới VariantOption
                                    VariantOption::create([
                                        'variant_id' => $attribute['variant'],
                                        'name' => $op,
                                    ]);
                                }
                            }
                        } else {
                            Log::error('Attribute options is not an array', ['attribute' => $attribute]);
                        }
                    }
                } else {
                    Log::error('variantAttributes is not an array', ['variantAttributes' => $this->variantAttributes]);
                }

                // Kiểm tra $this->variantCombinations có phải là mảng
                if (is_array($this->variantCombinations)) {
                    foreach ($this->variantCombinations as $com) {
                        Log::info('Processing combination', ['combination' => $com]);
                        $variant = new ProductVariant();
                        $variant->product_id = $product->id;
                        $variant->quantity = $com['quantity'];
                        $variant->price = $com['price'];
                        $variant->save();


                        // Tách các tùy chọn biến thể
                        $options = explode(' - ', $com['option']);
                        foreach ($options as $option) {
                            Log::info('Processing variant option', ['option' => $option]);
                            $variantOption = VariantOption::where('name', $option)->first();
                            if ($variantOption) {
                                SubVariant::create([
                                    'product_variant_id' => $variant->id,
                                    'variant_option_id' => $variantOption->id,
                                ]);
                            } else {
                                Log::error('Variant option not found', ['option' => $option]);
                            }
                        }
                    }
                } else {
                    Log::error('variantCombinations is not an array', ['variantCombinations' => $this->variantCombinations]);
                }
            }
            return redirect('/admin/addnew');
        } catch (\Exception $e) {
            Log::error('Error adding product', ['exception' => $e->getMessage(), 'product' => $this->name]);
            
        }
    }

    public function showAddCategoryModal()
    {
        $this->addCategoryModal = true;
    }

    // Ẩn modal thêm danh mục
    public function hideAddCategoryModal()
    {
        $this->addCategoryModal = false;
    }

    public function addnew_category()
    {
        $this->validate([
            'category_addnew' => 'required',
        ]);
        $categoryExist = Categories::where('name', $this->category_addnew)->first();
        if (!$categoryExist) {
            try {
                $category = new Categories();
                $category->name = $this->category_addnew;
                if (isset($this->parent_id)) {
                    $category->parent_id = $this->parent_id;
                }
                if ($category->parent_id == 0) {
                    $category->parent_id = null;
                }

                $category->save();

                Log::info("Category added successfully: {$category->name}");
                $this->category_addnew = '';
                $this->hideAddCategoryModal(); // Ẩn modal sau khi thêm danh mục
                return $this->redirect('/admin/addnew');
            } catch (\Exception $e) {
                Log::error('Error adding category' . ['category' => $this->category_addnew]);
                dd($e);
            }
        } else {
            session()->flash('categoryDup', 'Category already exists');
            $this->category_addnew = '';
        }
    }

    public function showVariantAttributeModal()
    {
        Log::info('showVariantAttributeModal called');
        $this->VariantAttributeModal = true;
    }

    public function hideVariantAttributeModal()
    {
        $this->VariantAttributeModal = false;
    }

    public function addNewVariantAttribute()
    {
        $this->validate([
            'newVariantName' => 'required',
        ]);

        $variant_addnew = new Variant();
        $variant_addnew->name = $this->newVariantName;
        $variant_addnew->save();


        $this->variantNames[] = $this->newVariantName;
        $this->newVariantName = '';
        $this->VariantAttributeModal = false;
    }

    public function removeVariantOption()
    {
        $this->numberOfVariantOptions--;
    }

}
