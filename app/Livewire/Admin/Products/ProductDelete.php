<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;

class ProductDelete extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function productConfirmDelete()
    {
        $this->dispatch('sweet:open', id: $this->product);
    }

    public function productDelete($product)
    {
        if($product = Product::find($product)) {
           $product->delete();
           $this->dispatch('productDeleted');
        }
    }

    protected function getListeners(): array
    {
        return [
          'productDelete:' . $this->product => 'productDelete'
        ];
    }

    public function render()
    {
        return view('livewire.admin.products.product-delete');
    }
}
