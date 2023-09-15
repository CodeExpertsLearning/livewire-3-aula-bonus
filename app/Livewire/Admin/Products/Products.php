<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    protected $products;

    public $update;
    #[On('productDeleted')]
    public function updateComp()
    {
        $this->update = !$this->update;
    }

    public function render()
    {
        return view('livewire.admin.products.products', ['products' => Product::orderBy('id', 'DESC')->paginate(10)]);
    }
}
