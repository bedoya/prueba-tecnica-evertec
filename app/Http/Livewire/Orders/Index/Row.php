<?php

namespace App\Http\Livewire\Orders\Index;

use App\Models\Order;
use Livewire\Component;

class Row extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.orders.index.row');
    }
}
