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
    public $quantityStock;
    public $selectedOptions = [];
    public $selectedOption;
    public $variantOptions = [];
    public $variants = [];
    public $price;
    public $category;
    public $categoryName;
    public $productSameCategory;

    public function mount($id)
    {
        $this->product = Product::with([
            'productVariants.subVariants.variantOption.variant.category',
            'productImages'
        ])->find($id);
        $this->variantOptions = $this->product->productVariants
            ->flatMap->subVariants
            ->pluck('variantOption')
            ->unique('id');
        $this->variants = Variant::whereIn('id', $this->variantOptions->pluck('variant_id'))->get();
        $this->productSameCategory = Product::where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->limit(8)
            ->get();

        if ($this->product->productVariants->count() == 1) {
            $this->price = $this->product->productVariants->first()->price;
        }
        if ($this->product->type == 'single') {
            $this->quantityStock = $this->product->productVariants->first()->quantity;
        }
        Log::info('quantity: ' . $this->quantity);
    }
    // Quantity
    public function increment_quantity()
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
                Log::info('aloalo ' . json_encode($productVariant));
                $this->quantityStock = $productVariant->quantity;
                Log::info('QuantityStock found: ' . $this->quantityStock);
                if ($this->quantity < $this->quantityStock) {
                    $this->quantity++;
                } else {
                    toast()->error('errorQuantity', 'The quantity must be less than the quantity in stock');
                }
            }
        }
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
        if (count($selectedOptions) === count($this->variants)) {
            $productVariant = ProductVariant::where('product_id', $this->product->id)
                ->whereHas('subVariants', function ($query) use ($selectedOptions) {
                    $query->whereIn('variant_option_id', $selectedOptions);
                }, '=', count($selectedOptions))
                ->first();

            if ($productVariant) {
                $this->price = $productVariant->price;
                $this->quantityStock = $productVariant->quantity;
                Log::info('QuantityStock found: ' . $this->quantityStock);
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
                $quantityInCart = session()->get('cart.' . $productVariant->id . '.quantity', 0);
                if ($this->quantity > $productVariant->quantity) {
                    toast()->error('The quantity must be less than the quantity in stock');
                    return;
                }
                if ($this->quantity + session()->get('cart.' . $productVariant->id . '.quantity') > $productVariant->quantity) {
                    toast()->error('There are ' . $quantityInCart . ' products in the cart. The quantity must be less than the quantity in stock.');
                    return;
                }
                
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
                        "price" => $this->price, // Ensure price is set correctly
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
            } else {
                Log::error('No matching productVariant found, unable to add to cart');
                toast()->error('No matching product variant found, unable to add to cart');
            }
        } else {
            Log::error('Selected options do not match variant count, unable to add to cart');
            toast()->error('Selected options do not match variant count, unable to add to cart');
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
