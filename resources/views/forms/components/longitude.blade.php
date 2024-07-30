<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
        start(position) {
            var coordenadas = position.coords;
            //console.log('Longitud: ' + coordenadas.longitude);
            //console.log('Más o menos ' + coordenadas.accuracy + ' metros.');
            this.state = coordenadas.longitude;
        },
    }" x-init="navigator.geolocation.getCurrentPosition(function(position) {
        start(position)
    })">
        <!-- Campo de entrada para la longitud -->

        <p x-model="state" x-text='state'></p>

    </div>
</x-dynamic-component>
