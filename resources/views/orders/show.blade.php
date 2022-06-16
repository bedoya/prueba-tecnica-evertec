<x-layout>
    <div class="card border-primary mb-3">
        <div class="card-header">
            <h5 class="p-0 m-0">{{ __('Resumen de su orden no. ' . $order->getReference()) }}</h5>
        </div>
        <div class="card-body bg-white">
            <div class="row mb-3 bg-dark bg-opacity-10 p-2">
                <div class="col-lg-3 py-2">{{ __('Nombre del cliente: ') }}</div>
                <div class="col-lg-9 py-2"><strong>{{ $order->client->customer_name }}</strong></div>
                <div class="col-lg-3 py-2">{{ __('Correo electrónico: ') }}</div>
                <div class="col-lg-9 py-2"><strong>{{ $order->client->customer_email }}</strong></div>
                <div class="col-lg-3 py-2">{{ __('Teléfono del cliente: ') }}</div>
                <div class="col-lg-9 py-2"><strong>{{ $order->client->customer_mobile }}</strong>
                </div>
            </div>
            <div class="row border border-dark rounded p-2">
                <div class="col-lg-3 offset-lg-1">
                    <span class="d-block text-center">{{ __('Fecha de la compra') }}</span>
                    <span class="d-block text-center"><strong>{{ $order->created_at->format('Y-m-d h:i:s') }}</strong></span>
                </div>
                <div class="col-lg-3">
                    <span class="d-block text-center">{{ __('Estado del pago') }}</span>
                    <span class="d-block text-center"><strong>{{ __($order->status->name) }}</strong></span>
                </div>
                <div class="col-lg-3">
                    <span class="d-block text-center">{{ __('# de transacción') }}</span>
                    <span class="d-block text-center"><strong>{{ $order->getData('transaction.request_id') }}</strong></span>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">{{ __('Nombre') }}</th>
                        <th scope="col" class="text-center">{{ __('Descripción') }}</th>
                        <th scope="col" class="text-center">{{ __('Precio') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr class="align-middle">
                            <th scope="row" class="text-end">{{ $product->id }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->getData('excerpt') }}</td>
                            <td class="text-end">{{ number_format($product->price, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-end" colspan="3"><strong>{{ __('Total') }}</strong></td>
                        <td class="text-end">{{ number_format($order->total, 2, ',', '.') }}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-layout>
