<?php

namespace App\Livewire\Store\Cart;

use App\Services\CartService;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{
    public $cartCount;

    #[On('cart-update')]
    public function cartCountUpdate(CartService $cartService)
    {
        $this->cartCount = $cartService->count();
    }

    public function render(CartService $cartService)
    {
        $this->cartCount = $cartService->count();

        return view('livewire.store.cart.cart-icon');
    }
}
