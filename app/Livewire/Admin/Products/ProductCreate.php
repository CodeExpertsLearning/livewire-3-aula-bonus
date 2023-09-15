<?php

namespace App\Livewire\Admin\Products;

use App\Livewire\Forms\ProductForm;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProductCreate extends Component
{
    use WithFileUploads;

    public ProductForm $form;

    #[Rule('nullable|image')]
    public $photo;

    public $allCategories;

    #[Rule('nullable|array')]
    public $categories = [];

    public function mount(Category $category)
    {
        $this->allCategories = $category->pluck('name', 'id')->toArray();
    }

    public function syncProduct()
    {
        $photo = $this->photo?->store('products', 'public');

        $this->form->setPhoto($photo);
        $this->form->setCategories($this->categories);

        $this->form->store();

        session()->flash('success', 'Produto criado com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.products.form.product-form');
    }
}
