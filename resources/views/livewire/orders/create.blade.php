<div class="card @if($products->count() == 0) d-none @endif">
    @if($products->count() > 0)
    <div class="card-header">
        <h5 class="card-title">{{ __('Diligencie sus datos') }}</h5>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="input-name"><i class="fa-solid fa-person"></i></span>
                        <input type="text" wire:model="name" class="form-control @error('name')  is-invalid @enderror" placeholder="{{ __('Ingrese su nombre') }}">
                        @error('name') <small class="invalid-feedback">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="input-email"><i class="fa-solid fa-at"></i></span>
                        <input type="text" wire:model="email" class="form-control @error('email')  is-invalid @enderror" placeholder="{{ __('Indiquenos su correo electrónico') }}">
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="input-email"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" wire:model="phone" class="form-control @error('phone')  is-invalid @enderror" placeholder="{{ __('Número telefónico') }}">
                        @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-primary" wire:click="createOrder">
            <i class="fa-solid fa-cart-shopping me-2"></i>
            {{ __('Comprar') }}
        </button>
    </div>
    @endif
</div>
