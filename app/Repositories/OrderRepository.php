<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class OrderRepository
{
    public function __construct(private Order $order, private CartService $cartService)
    {
    }

    public function createOrder()
    {
        $order = $this->order->create([
            'user_id' => auth()->id(),
            'transaction_code' => Str::uuid(),
            'amount_value' => $this->sumTotalOrder()
        ]);

        $order->items()->sync($this->cartService->all());
    }

    private function sumTotalOrder()
    {
        /**
         * @var Collection $prices
         */
        $prices = Product::whereIn('id', $this->cartService->all())->get(['price']);

        return $prices->reduce(function($ini, $product) {
            return $ini+= $product->price;
        }, 0);
    }
}
