<x-layout>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col" class="text-center">{{ __('Nombre') }}</th>
            <th scope="col" class="text-center">{{ __('Descripción') }}</th>
            <th scope="col" class="text-center">{{ __('Precio') }}</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="align-middle">
                <th scope="row" class="text-end">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->getData('excerpt') }}</td>
                <td class="text-end">{{ number_format($product->price, 2, ',', '.') }}</td>
                <td class="text-center">
                    <a href="{{ route('products.show', [$product]) }}" type="button" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-eye me-2"></i>
                        {{ __('Detalle') }}
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
