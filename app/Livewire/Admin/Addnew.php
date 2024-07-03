<?php

namespace App\Livewire\Admin;

use App\Models\Categories;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\SubVariant;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Support\Facades\Log;
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



    public function store_product()
    {
        Log::info('store_product method called', ['product_type' => $this->product_type]);
        try {
            if ($this->product_type == 'single') {
                Log::info('Processing single product type');
                $this->variantNames = [];
                $this->values = [];
                $this->quantities = [];
                $this->prices = [];

                $product = new Product();
                $product->name = $this->name;
                $product->description = $this->description;
                $product->category_id = $this->category_id;
                $product->type = $this->product_type;
                $product->save();

                Log::info('Product saved', ['product_id' => $product->id]);

                $this->name = '';
                $this->description = '';
                $this->category_id = '';


                foreach ($this->images as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    // Store the image in the 'public' disk
                    $image->storeAs('assets/images', $imageName, 'public');
                    // Generate a storage path URL
                    $imagePath = 'assets/images/' . $imageName;

                    ProductImage::create([
                        'path' => $imagePath, // Store the storage path
                        'product_id' => $product->id,
                    ]);
                    Log::info('Image uploaded', ['path' => $imagePath, 'product_id' => $product->id]);
                }

                ProductVariant::create([
                    'product_id' => $product->id,
                    'quantity' => $this->quantity_single,
                    'price' => $this->price_single,
                ]);

                Log::info('Product variant created', [
                    'product_id' => $product->id,
                    'quantity' => $this->quantity_single,
                    'price' => $this->price_single,
                ]);
            } else {
                Log::info('Non-single product type not handled', ['product_type' => $this->product_type]);
            }
            Log::info('Product added successfully: ' . $product->name);

            return $this->redirect('/admin/addnew');
        } catch (\Exception $e) {
            Log::error('Error adding product', ['exception' => $e->getMessage(), 'product' => $this->name]);
            dd($e);
        }
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


    public function render()
    {
        $data = [
            'category' => Categories::all(),
            'variants_display' => Variant::all(),
            'variant_options_display' => VariantOption::all(),
        ];

        return view('livewire.admin.addnew', $data);
    }

    public function selectedCategory($level)
    {
        if($level == 0){
            $this->selectedCategory = [];
            $this->parent_id = null;
        } else {
            $this->parent_id = $level;
        }
    }
}
