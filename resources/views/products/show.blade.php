<x-layout>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $product->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $product->getData('excerpt') }}</h6>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $product->getData('description') }}.</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('orders.create', product detail[$product]) }}" class="btn btn-primary">
                <i class="fa-solid fa-cart-shopping me-2"></i>
                {{ __('Comprar') }}
            </a>
        </div>
    </div>
</x-layout>
