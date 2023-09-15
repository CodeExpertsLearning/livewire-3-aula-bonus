<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductEdit extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    #[Rule('nullable|image')]
    public $photo;

    public $allCategories;

    #[Rule('nullable|array')]
    public $categories = [];

    public function mount(Product $product, Category $category)
    {
        $this->allCategories = $category->pluck('name', 'id')->toArray();
        $this->categories = $product->categories->pluck('id')->toArray();
        $this->categories = array_fill_keys($this->categories, true);

        $this->form->setProduct($product);
        $this->form->setUpdate(true);
    }

    public function syncProduct()
    {

        $photo = $this->photo?->store('products', 'public');
        $this->form->setPhoto($photo);
        $this->form->setCategories($this->categories);

        $this->form->update();

        redirect()->route('admin.product.index');
    }
    public function render()
    {
        return view('livewire.admin.products.form.product-form');
    }
}
