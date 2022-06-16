<?php

namespace App\Http\Livewire\Orders;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class Create extends Component
{
    public Collection $products;
    public ?string $name = null;
    public ?string $email = null;
    public ?string $phone = null;

    protected $listeners = [
        'productAdded',
    ];

    protected array $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
        'phone' => 'required|phone:CO',
    ];

    /**
     * Mounts the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->products = collect();

    }

    /**
     * Adds a product to the order
     *
     * @param $product_id
     *
     * @return void
     */
    public function productAdded($product_id): void
    {
        $product = Product::find($product_id);
        $this->products->push($product);
    }

    /**
     * Creates the order and sends the user to complete the process
     *
     * @return void
     */
    public function createOrder()
    {
        $this->validate();

        $client = Client::updateOrCreate(
            ['customer_name' => $this->email],
            [
                'customer_name' => $this->name,
                'customer_mobile' => $this->phone,
            ]);

            $order = $client->orders()->create(['total' => 0]);

        foreach ($this->products as $product) {
            $order->addProduct($product);
        }
    }

    /**
     * Displays the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.orders.create');
    }
}
