<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
<style>
.container {
    display: grid;
    height: 33vh;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-auto-columns: 1fr;
    gap: 0px 0px;
    grid-auto-flow: row;
    grid-template-areas:
      "cam screenshot"
      "bottom bottom";
  }

  .screenshot {
      grid-area: screenshot;
      margin: 5px
  }

  .cam { grid-area: cam;
      margin: 5px;
  }

  .bottom { grid-area: bottom;
      display: block;
      padding: 10px;
        margin-left: auto;
        margin-right: auto;}

</style>

    <div x-data="{
        state: $wire.$entangle('{{ $getStatePath() }}'),
        foto(data_uri) {
            //console.log(data_uri);
            this.state = data_uri;
            document.getElementById('results').innerHTML = '<img src=' + data_uri+ ' '+ '/>';
            //$refs.results.innerHTML = '<img src=' + data_uri + '/>'
        }
    }">
        <div class="container">
            <div class="cam">
                <div id="my_camera"></div>
                <p x-model="state" x-text='state' hidden></p>
            </div>
            <div class="screenshot">
                <div x-ref="results" id="results"></div>
            </div>
            <div class="bottom">
                <x-filament::button icon="heroicon-s-camera"
                   x-on:click=" Webcam.snap(function(data_uri) {foto(data_uri)})">
                    {{__('general.take_photo')}}
                </x-filament::button>
            </div>
        </div>


    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

    <script language="JavaScript">
        Webcam.set({
            width: 200,
            height: 150,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function (data_uri) {
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            });
        }
    </script>
</x-dynamic-component>
