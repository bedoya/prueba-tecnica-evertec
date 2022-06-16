<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ __('Menu') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Activar navegación') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">{{ __('Inicio') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Productos') }}</a>
                </li>
                @can('manage-store')
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Todas las órdenes') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ __('Mis órdenes') }}</a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
