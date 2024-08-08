<x-filament-panels::page>
    <style>
        .flex-container {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-around;
            align-items: center;
            align-content: stretch;
        }

        .flex-items:nth-child(1) {
            display: block;
            flex-grow: 0;
            flex-shrink: 1;
            flex-basis: auto;
            align-self: auto;
            order: 0;
            width: 80vh;
        }

        .flex-items:nth-child(2) {
            display: block;
            flex-grow: 0;
            flex-shrink: 1;
            flex-basis: auto;
            align-self: auto;
            order: 0;
            width: 80vh;
        }
    </style>
    <div class="flex-container">
        <div class="flex-items">
            <x-filament::fieldset>
                <x-slot name="label">
                    {{ __('general.data_in') }}
                </x-slot>
                {{ __('general.code') }}
                <x-filament::input.wrapper>
                    <x-filament::input type="text" onchange="searchEmployee(this.value)" id='input_code' />
                </x-filament::input.wrapper>
                {{ __('general.date_time') }}
                <x-filament::input.wrapper disabled>
                    <x-filament::input type="dateTime" id='date_time' disabled />
                </x-filament::input.wrapper>
            </x-filament::fieldset>
        </div>
        <div class="flex-items">
            <x-filament::section>
                <x-slot name="heading">
                    User details
                </x-slot>
                <div class="flex-container">
                    <div class="flex-items">
                        <x-filament::avatar src="{{ url('imagenes/chekeo/guard.svg') }}" alt="Dan Harrin" id='avatar'
                            style="width: 200px; height: 200px;" />
                    </div>
                    <div class="flex-items">
                        {{ __('general.name') }}
                        <x-filament::input.wrapper disabled>
                            <x-filament::input type="dateTime" id='name' disabled />
                        </x-filament::input.wrapper>
                        {{ __('general.access') }}
                        <x-filament::input.wrapper disabled>
                            <x-filament::input type="dateTime" id='access' disabled />
                        </x-filament::input.wrapper>
                    </div>
                </div>
            </x-filament::section>
        </div>
    </div>
    <script>
        document.getElementById("input_code").focus();

        let fechaActual = new Date();
        let day = fechaActual.getDay();
        let date = fechaActual.getDate();
        let year = fechaActual.getFullYear();

        let fomartoDate = day + '/' + date + '/' + year;

        function startTime() {
            var today = new Date();
            var hr = today.getHours();
            var min = today.getMinutes();
            var sec = today.getSeconds();
            //Add a zero in front of numbers<10
            min = checkTime(min);
            sec = checkTime(sec);

            document.getElementById("date_time").value = fomartoDate + " " + hr + ":" + min;
            var time = setTimeout(function() {
                startTime()
            }, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        window.onload = startTime;
    </script>
    <script>
        function searchEmployee(code) {
            var defaultIMG = "{{ url('imagenes/chekeo/guard.svg') }}"
            //console.log(defaultIMG);

            // clearData();
            const update = {
                ci: code,
            };
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(update),
            };
            //console.log('{{ route('api.access.setOut') }}');
            fetch('{{ route('api.access.setOut') }}', options)
                .then(response => {
                    //console.log(response);
                    if (!response.ok) {
                        document.getElementById('access').value = "Error";
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    clearInput();
                    document.getElementById("input_code").focus();
                    document.getElementById('name').value = data.user?.name ?? 'Sin datos';
                    const avatar = document.getElementById('avatar');
                    //console.log(data.user.avatar_url);
                    avatar.setAttribute("src", data.user.avatar_url);
                    if (data.user?.avatar_url == null) {
                        avatar.setAttribute("src", defaultIMG);
                    }
                    avatar.setAttribute("alt", data.user?.name ?? 'Sin datos');
                    document.getElementById('access').value = data.message;
                })
                .catch(error => document.getElementById('access').value = 'Ocurrio un error');
        }

        function clearInput() {
            let fechaActual = new Date();
            let day = fechaActual.getDay();
            let date = fechaActual.getDate();
            let year = fechaActual.getFullYear();
            let hour = fechaActual.getHours();
            let min = fechaActual.getMinutes();

            let fomartoDate = day + '/' + date + '/' + year;
            let formartTime = hour + ':' + min;

            document.getElementById('date_time').value = fomartoDate + ' ' + formartTime;
            document.getElementById('input_code').value = null;
        }

        function clearData() {
            let fechaActual = new Date();
            let day = fechaActual.getDay();
            let date = fechaActual.getDate();
            let year = fechaActual.getFullYear();
            let hour = fechaActual.getHours();
            let min = fechaActual.getMinutes();

            let fomartoDate = day + '/' + date + '/' + year;
            let formartTime = hour + ':' + min;

            document.getElementById('date_time').value = fomartoDate + ' ' + formartTime;
            document.getElementById('name').value = null;
            // document.getElementById('avatar').src = null;
        }
    </script>

</x-filament-panels::page>
