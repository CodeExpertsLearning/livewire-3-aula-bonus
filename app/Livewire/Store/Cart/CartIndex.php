<?php

namespace App\Livewire\Store\Cart;

use App\Models\Product;
use App\Services\CartService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class CartIndex extends Component
{
    public $cartItems;

    public function mount(CartService $cartService)
    {
        $this->loadProductsByCartIds($cartService);
    }

    #[Layout('layouts.store')]
    public function render(CartService $cartService)
    {
        return view('livewire.store.cart.cart-index');
    }

    public function removeItem($item)
    {
        $cart = app(CartService::class);
        $cart->remove($item);

        $this->loadProductsByCartIds($cart);
        $this->dispatch('cart-update');
    }

    public function clearCart(CartService $cartService)
    {
        $cartService->clear();

        //$this->loadProductsByCartIds($cartService);
        $this->dispatch('cart-update');
    }

    private function loadProductsByCartIds(CartService $cartService)
    {
        $this->cartItems = Product::whereIn('id', $cartService->all())->get(['id', 'name', 'price', 'photo']);
    }
}
