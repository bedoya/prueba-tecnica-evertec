<x-layout>
    <div class="card border-primary mb-3">
        <div class="card-header">
            <h5 class="p-0 m-0">{{ __('Prueba técnica') }}: Andrés Bedoya</h5>
        </div>
        <div class="card-body">
            <p class="card-text">
                <h5>Vistas incluídas en el proyecto</h5>
                Gracias por tenerme en cuenta para presentar esta prueba. Este es el proyecto que he creado para mostrar
                mi conocimiento de Laravel para la prueba técnica. En este proyecto encontrarán lo siguiente:
                <ul class="list-group">
                <li class="list-group-item">Esta página inicial de contenidos.</li>
                <li class="list-group-item">Una vista con el listado de productos.</li>
                <li class="list-group-item">Una vista de detalle del producto desde la que se puede hacer checkout.</li>
                <li class="list-group-item">Una vista con el resumen de la orden finalizada.</li>
                <li class="list-group-item">Una vista con el listado de órdenes de la tienda.</li>
                </ul>
            </p>
            <p class="card-text">
                Para acceder a ella utilice las siguientes credenciales:
                <span class="d-block font-monospace mt-3">Usuario: <strong>admin</strong></span>
                <span class="d-block font-monospace">Contraseña: <strong>123456</strong></span>
            </p>
            <p class="card-text">
                <h5>Paquetes utilizados en este programa</h5>
                <ul class="list-group">
                    <li class="list-group-item">
                        La tienda utiliza Bootstrap 5 y Fontawesome 6, para instalarlos no olvide debe ejecutar
                        <span class="font-monospace"><strong>npm run dev</strong></span>.
                    </li>
                    <li class="list-group-item">
                        Para generar automáticamente los slugs de los productos he utilizado el paquete
                        <span class="font-monospace"><strong>cviebrock/eloquent-sluggable</strong></span>.
                    </li>
                    <li class="list-group-item">
                        Para validar los números telefónicos hago uso del paquete
                        <span class="font-monospace"><strong>propaganistas/laravel-phone</strong></span>.
                    </li>
                    <li class="list-group-item">
                        Para permitir el manejo de permisos y limitar el ingreso al listado de órdenes del punto 4 he instalado
                        el paquete <span class="font-monospace"><strong>spatie/laravel-permission</strong></span>.
                    </li>
                </ul>
            </p>
        </div>
    </div>
</x-layout>
