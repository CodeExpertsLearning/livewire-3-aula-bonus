<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ProductForm extends Form
{
    public ?Product $product;

    #[Rule('required')]
    public string $name;

    #[Rule('required')]
    public string $description;

    #[Rule('required')]
    public string $body;

    #[Rule('required')]
    public string $price;

    #[Rule('nullable')]
    public ?string $photo;

    #[Locked]
    protected array $insideCategories;

    public function setPhoto(?string $photoReference)
    {
        $this->photo = $photoReference;
    }

    public function setCategories(?array $categories)
    {
        $this->insideCategories = $categories?? [];
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->body = $product->body;
        $this->price = $product->price;
    }

    public function store()
    {
        $this->validate();

        $data = $this->except(['product']);

        $product = Product::create($data);
        $product->categories()->sync(array_keys($this->insideCategories, 1));
    }

    public function update()
    {
        $this->post->update(

        );
    }
}
