<?php

namespace App\Http\Livewire\Orders\Index;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Table extends Component
{
    public Collection $orders;

    /**
     * Mounts the component
     *
     * @return void
     */
    public function mount(): void
    {
        $this->orders = Order::all();
    }

    /**
     * Displays the component
     *
     * @return View
     */
    public function render(): View
    {
        return view('livewire.orders.index.table');
    }
}
