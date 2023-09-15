<?php

namespace App\Livewire\Admin\Products\Form;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    protected $rules = [
        'product.name' => 'required',
        'product.description' => 'required',
        'product.body' => 'required',
        'product.price' => 'required',
        'photo' => 'nullable|image'
    ];
    public function mount(Category $category, ?int $product = null)
    {
        $this->product = is_null($product) ? new Product() : Product::find($product);
        $this->categories = $this->product->categories->pluck('id')->toArray();
        $this->categories = array_fill_keys($this->categories, 1);
        $this->allCategories = $category->pluck('name', 'id')->toArray();
    }

    public function syncProduct()
    {
        $this->validate();

        $this->product->photo = $this->photo?->store('products', 'public') ?? $this->product->photo;
        $this->product->save();
        $this->product->categories()->sync(array_keys($this->categories, 1));

        redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.products.form.product-form');
    }
}
