<?php

namespace App\Http\Livewire\Orders;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Redirector;

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
     * @param Order|null $order
     *
     * @return void
     */
    public function mount(Order $order = null): void
    {
        $this->products = collect();
        if ($order != null) {
            $this->products = $order->products->pluck('id');
            $this->name = $order->client->customer_name;
            $this->email = $order->client->customer_email;
            $this->phone = $order->client->customer_mobile;
        }
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

        $this->products->push($product->id);
    }

    /**
     * Creates the order and sends the user to complete the process
     *
     * @return Redirector|RedirectResponse
     */
    public function createOrder(): Redirector|RedirectResponse
    {
        $this->validate();

        $status = Status::where('slug', Str::slug('Created'))->first();
        $client = Client::updateOrCreate(
            ['customer_email' => $this->email],
            ['customer_name' => $this->name, 'customer_mobile' => $this->phone]
        );
        $order = $client->orders()->create(['total' => 0, 'status_id' => $status->id]);
        $order->setReference();

        foreach ($this->products as $product) {
            $order->addProduct($product);
        }

        $order->prepareCheckout();
        if ($order->canBeProcessed()) {
            return redirect($order->getProcessUrl());
        } else {
            return redirect()->route('products.index')->with('message', __('Su transacción no se puede iniciar'));
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
