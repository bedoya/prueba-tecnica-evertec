<x-layout>
    @foreach($order->products as $product)
        <livewire:products.show :product="$product" :purchasing="true" />
    @endforeach
    <livewire:orders.create :order="$order" />
</x-layout>
