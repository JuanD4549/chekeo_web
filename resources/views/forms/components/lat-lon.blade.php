<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
        <p id="demo"></p>
    </div>


    <script>
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            document.getElementById("demo").innerHTML =
                "Geolocation is not supported by this browser.";
        }

        function showPosition(position) {
            document.getElementById("demo").innerHTML =
                "Latitude: " + position.coords.latitude + "<br>" +
                "Longitude: " + position.coords.longitude;
        }
    </script>
</x-dynamic-component>
