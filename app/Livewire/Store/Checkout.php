<?php

namespace App\Livewire\Store;

use App\Repositories\OrderRepository;
use App\Services\CartService;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Checkout extends Component
{
    #[Layout('layouts.store')]
    public function render()
    {
        return view('livewire.store.checkout');
    }

    public function makePayment(OrderRepository $orderRepository, CartService $cartService)
    {
        $orderRepository->createOrder();
        $cartService->clear();

        $this->redirect(route('store.home'), true);
    }
}
