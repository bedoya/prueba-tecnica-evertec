<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Show extends Component
{
    public Product $product;
    public bool $purchasing = false;

    /**
     * Executes the action to add the product to the order
     *
     * @return void
     */
    public function addProduct(): void
    {
        $this->purchasing = true;
        $this->emit('productAdded', $this->product->id);
    }

    /**
     * Displays the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.products.show');
    }
}
