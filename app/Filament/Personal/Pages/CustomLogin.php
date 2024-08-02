<?php

namespace App\Filament\Personal\Pages;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseAuth;
use Illuminate\Validation\ValidationException;

class CustomLogin extends BaseAuth
{
    protected static string $view = 'filament.personal.pages.custom-login';
    
    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }
    protected function getCredentialsFromFormData(array $data): array
    {
        //dd($data);
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'ci';
        //dd($login_type);

        return [
            $login_type => $data['login'],
            'password' => $data['password'],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //$this->getEmailFormComponent(),
                $this->getLoginFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.login' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
}
