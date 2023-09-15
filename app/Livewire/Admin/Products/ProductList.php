<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    #[On('productDeleted')]
    public function reactList()
    {
        session()->flash('success', 'Produto removido com sucesso!');
    }

    public function render()
    {
         return view('livewire.admin.products.product-list');
    }
}
