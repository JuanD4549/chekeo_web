<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Department;
use App\Models\Place;
use App\Models\User;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    //protected static ?int $navigationSort = 62;
    public static function getModelLabel(): string
    {
        return __('general.pages.user');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.users');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.user');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('general.data.data_employee'))
                    ->columns(3)
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->label(__('general.form.photo', ['number' => '']))
                            ->directory('users')
                            ->avatar(),
                        TextInput::make('email')
                            ->label(__('general.form.mail'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),
                    ]),

                Section::make('')
                    ->columns(3)
                    ->schema([
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                        TextInput::make('password')
                            ->label(__('general.form.password'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit'),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('general.form.name'))
                    ->searchable(),

                TextColumn::make('roles.name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Verify')
                    ->icon('heroicon-o-check-badge')
                    ->action(function (User $user) {
                        $user->email_verified_at = Date('Y-m-d H:i:s');
                        $user->save();
                    }),
                Tables\Actions\Action::make('Unverify')
                    ->icon('heroicon-o-x-circle')
                    ->action(function (User $user) {
                        $user->email_verified_at = null;
                        $user->save();
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CalendarsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
