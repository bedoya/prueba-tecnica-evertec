<x-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ __('Resumen de las transacciones en el sistema') }}</h5>
        </div>
        <div class="card-body">
            <livewire:orders.index.table />
        </div>
    </div>
</x-layout>
