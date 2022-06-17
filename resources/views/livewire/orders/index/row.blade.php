<tr class="bg-opacity-25 @if($order->hasStatus('Payed')) bg-success @elseif($order->hasStatus('Created')) bg-warning @elseif($order->hasStatus('Rejected')) bg-danger @endif">
    <td>{{ $order->client->customer_name }}</td>
    <td>{{ $order->client->customer_email }}</td>
    <td>{{ $order->client->customer_mobile }}</td>
    <td>
        @foreach($order->products as $product)
            {{ $product->name }}
        @endforeach
    </td>
    <td class="text-center">
        {{ __($order->status->name) }}
    </td>
    <td class="text-center">
        {{ number_format($order->total, 2, ',', '.') }}
    </td>
</tr>
