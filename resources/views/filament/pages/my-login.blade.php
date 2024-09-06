<div>
    <style>
        body {
            min-height: 100vh;
            min-width: 100vh;
        }

        .text-gray-950 {
            --tw-text-opacity: 1;
            color: white;
        }

        .fi-body {
            background-color: white;
            background-repeat: no-repeat;
            background-position: left center;
            //width: ;
            background-size: 135vh;
            background-image: url({{ asset('imagenes/chekeo/back.svg') }});
        }

        .fi-simple-layout {
            / / height: 100 vh;
            / / width: 400 em;
            margin-top: 0;
            margin-left: 0;
        }

        .fi-simple-main-ctn {
            display: flex;
            / / height: 100 vh;
            margin-top: 0;
            margin-left: 0;
            justify-content: end;
            justify-items: center;
            flex-grow: 0;
        }

        .fi-simple-main {
            display: flex;
            margin-top: 0;
            margin-bottom: 0;
            justify-content: center;
            align-items: center;
            height: 100vh;
            border-radius: 0;
            background: #234EC3;
            background: radial-gradient(at center top, #234EC3, #010101);
        }

        .MyImgContainer {}

        .myImg {
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 3em;
            width: 35vh;
        }

        input[type=text] {
            color: black;
        }

        input[type=password] {
            color: black;
        }
    </style>
    <div class="MyImgContainer">
        <img class="myImg" src={{ asset('storage/emprise/logo_empresa.png') }} alt="">
    </div>
    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}

            {{ $this->registerAction }}
        </x-slot>
    @endif
    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
        scopes: $this->getRenderHookScopes(),
    ) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">

        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getCachedFormActions()" :full-width="$this->hasFullWidthFormActions()" />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(
        \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
        scopes: $this->getRenderHookScopes(),
    ) }}
</div>
