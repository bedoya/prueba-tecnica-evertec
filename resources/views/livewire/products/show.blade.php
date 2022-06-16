<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">{{ $product->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted">{{ $product->getData('excerpt') }}</h6>
    </div>
    <div class="card-body">
        <p class="card-text">{{ $product->getData('description') }}.</p>
    </div>
    @if(!$purchasing)
        <div class="card-footer text-end">
            <button class="btn btn-primary" wire:click="addProduct">
                <i class="fa-solid fa-cart-shopping me-2"></i>
                {{ __('Comprar') }}
            </button>
        </div>
    @endif
</div>
