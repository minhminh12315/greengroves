<?php

namespace App\Livewire\User;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Variant;
use App\Models\VariantOption;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProductDetail extends Component
{
    public $product;
    public $quantity = 1;
    public $selectedOptions = [];
    public $selectedOption;
    public $variantOptions = [];
    public $variants = [];
    public $price;
    public $category;
    public $categoryName;

    public function mount($id)
    {
        $this->product = Product::with([
            'productVariants.subVariants.variantOption.variant',
            'productImages'
        ])->find($id);
        $this->variantOptions = $this->product->productVariants
            ->flatMap->subVariants
            ->pluck('variantOption')
            ->unique('id');
        // Log::info('variantOptions: ' . json_encode($this->variantOptions));
        $this->variants = Variant::whereIn('id', $this->variantOptions->pluck('variant_id'))->get();
        Log::info('price: ' . $this->price);
        Log::info('productVariants count: ' . $this->product->productVariants->count());
        Log::info('productVariants: ' . json_encode($this->product->productVariants));
        if ($this->product->productVariants->count() == 1) {
            $this->price = $this->product->productVariants->first()->price;
        }
        Log::info('price after fix: ' . $this->price);
        Log::info('product name: ' . $this->product->name);
    }
    // Quantity
    public function increment_quantity()
    {
        $this->quantity++;
    }
    public function decrement_quantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function updateSelectedOptions()
    {
        Log::info('selectedOptions: ' . json_encode($this->selectedOptions));
        $this->calculatePrice();
    }
    public function calculatePrice()
    {
        $selectedOptions = $this->selectedOptions;

        Log::info('Calculating price with selected options: ' . json_encode($selectedOptions));
        Log::info('Total variants count: ' . count($this->variants));

        if (count($selectedOptions) === count($this->variants)) {
            $productVariant = ProductVariant::where('product_id', $this->product->id)
                ->whereHas('subVariants', function ($query) use ($selectedOptions) {
                    $query->whereIn('variant_option_id', $selectedOptions);
                }, '=', count($selectedOptions))
                ->first();

            if ($productVariant) {
                Log::info('Matching productVariant found: ' . json_encode($productVariant));
                $this->price = $productVariant->price;
                Log::info('Calculated price: ' . $this->price);
            } else {
                $this->price = 0;
                Log::info('No matching productVariant found, price set to 0');
            }
        } else {
            $this->price = 0;
            Log::info('Selected options do not match variant count, price set to 0');
        }
    }
    public function addToCart()
    {
        $selectedOptions = $this->selectedOptions;

        if (count($selectedOptions) === count($this->variants)) {
            $productVariant = ProductVariant::where('product_id', $this->product->id)
                ->whereHas('subVariants', function ($query) use ($selectedOptions) {
                    $query->whereIn('variant_option_id', $selectedOptions);
                }, '=', count($selectedOptions))
                ->first();
            if ($productVariant) {
                // Lấy thông tin các biến thể (variant) và tên biến thể (variant option)
                $variants = [];
                foreach ($productVariant->subVariants as $variant) {
                    $variantOption = VariantOption::find($variant->variant_option_id);
                    $variantOption->variant = Variant::find($variantOption->variant_id);
                    $variants[] = [
                        'variant_name' => $variantOption->variant->name,
                        'variant_option_name' => $variantOption->name,
                    ];
                }

                $cart = session()->get('cart', []);

                if (isset($cart[$productVariant->id])) {
                    $cart[$productVariant->id]['quantity'] += $this->quantity;
                } else {
                    $cart[$productVariant->id] = [
                        "name" => $this->product->name,
                        "image" => $this->product->productImages->first()->path,
                        "product_id" => $this->product->id,
                        "variant_id" => $productVariant->id,
                        "quantity" => $this->quantity,
                        "price" => $this->price,
                        "variants" => $variants, 
                    ];
                }
                Log::info('cart: ' . json_encode($cart));

                session()->put('cart', $cart);

                try {
                    $this->dispatch('cartUpdated');
                    Log::info('cartUpdated event dispatched');
                } catch (\Exception $e) {
                    Log::error('Error dispatching cartUpdated event: ' . $e->getMessage());
                }
                
                $this->quantity = 1;
                $this->selectedOptions = [];
                $this->price = 0;
                session()->flash('success', 'Product added to cart successfully!');
            }
        }
    }

    public function buyNow()
    {
        $this->addToCart();
        return redirect()->route('user.cartShop');
    }
    public function render()
    {
        $this->category = $this->product->category;
        $this->categoryName = $this->category->name;
        return view('livewire.user.product-detail', [
            'product' => $this->product,
            'variants' => $this->variants,
            'variantOptions' => $this->variantOptions,
            'price' => $this->price,
        ]);
    }
}
