<x-filament-panels::page>
    <x-filament::fieldset>
        <x-slot name="label">
            {{__('general.code')}}
        </x-slot>

        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model="user_id"
            />
        </x-filament::input.wrapper>
    </x-filament::fieldset>

    <x-filament::fieldset>
        <x-slot name="label">
            Address
        </x-slot>

        <x-filament::input.wrapper>
            <x-filament::input
                type="dateTime"
                wire:model="user_id"
                id='date_time'
                disabled
            />
        </x-filament::input.wrapper>
    </x-filament::fieldset>
    <x-filament::section>
        <x-slot name="heading">
            User details
        </x-slot>
        <x-filament::loading-indicator class="h-5 w-5"/>
    </x-filament::section>
    <script>
        let fechaActual = new Date();
        let day = fechaActual.getDay();
        let date = fechaActual.getDate();
        let year = fechaActual.getFullYear();
        let hour = fechaActual.getHours();
        let min = fechaActual.getMinutes();

        let fomartoDate = day + '/' + date + '/' + year;
        let formartTime = hour + ':' + min;

        document.getElementById('date_time').value = fomartoDate + ' ' + formartTime;
    const update = {
        branche_id:1,
        user_id: 1,
        date_time_in:'5/8/2024 22:43'
        };
        
        const options = {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        },
        body: JSON.stringify(update),
        };
        fetch('http://localhost:8000/api/admin/accesses',options)
            .then(data => {
                return data.json();
            })
            .then(post => {
                console.log(post);
            });
        
    </script>

</x-filament-panels::page>
