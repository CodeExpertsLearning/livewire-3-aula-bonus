<?php

namespace App\Livewire\Store;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    #[Layout('layouts.store')]
    public function render()
    {
        return view('livewire.store.home', ['products' => Product::orderBy('id', 'DESC')->paginate(12)]);
    }

    public function addCart(int $product)
    {
        /**
         * @var CartService $cart
         */
        $cart = app(CartService::class);
        $cart->add($product);


        $this->dispatch('cart-update');
    }
}
