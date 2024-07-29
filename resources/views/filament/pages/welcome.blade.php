<x-filament-panels::page>
    <style>
        #welcome_logo {
            /* background-color: blue; */
            width: 100%;
        }

        #container_logo {
            height: 60%;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <div id="container_logo">
        <img id="welcome_logo"src={{ asset('imagenes/chekeo/logo_ligth.svg') }} />
    </div>
</x-filament-panels::page>
