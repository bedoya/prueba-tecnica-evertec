<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr class="align-middle">
            <th scope="col">{{ __('Nombre del cliente') }}</th>
            <th scope="col">{{ __('Correo electrónico') }}</th>
            <th scope="col">{{ __('Teléfono móvil') }}</th>
            <th scope="col">{{ __('Producto adquirido') }}</th>
            <th scope="col" class="text-center">{{ __('Estado de la compra') }}</th>
            <th scope="col" class="text-center">{{ __('Valor total') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <livewire:orders.index.row :order="$order" />
        @endforeach
        </tbody>
    </table>
</div>
