<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">

    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
        foto(data_uri) {
            //console.log(data_uri);
            this.state = data_uri;
            $refs.results.innerHTML = '<img src=' + data_uri + '/>'
        }
    }">
        <div class="row">
            <div id="my_camera"></div>
            <p x-model="state" x-text='state' hidden></p>
            <div x-ref="results"></div>
        </div>
        <div class="row">
            <button type=button x-on:click=" Webcam.snap(function(data_uri) {foto(data_uri)})">Tomar foto </button>
        </div>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script language="JavaScript">
        Webcam.set({
            width: 250,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
</x-dynamic-component>
