<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\Department;
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
        return __('general.user');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.users');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.user');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.settings');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Data')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('password')
                            ->password()
                            ->required()
                            ->hiddenOn('edit'),
                        Toggle::make('status')
                            ->default(true),
                    ]),
                Section::make('Personal Data')
                    ->description('Prevent abuse by limiting the number of requests per period')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->directory('users')
                            ->avatar(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Select::make('blood_type')
                            ->options([
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                            ]),
                        Select::make('drive_license')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'F' => 'F',
                                'A1' => 'A1',
                                'C' => 'C',
                                'C1' => 'C1',
                                'D' => 'D',
                                'D1' => 'D1',
                                'E' => 'E',
                                'E1' => 'E1',
                                'G' => 'G'
                            ]),
                        TextInput::make('cellphone')
                            ->maxLength(10),
                        TextInput::make('phone')
                            ->maxLength(10),
                        TextInput::make('address')
                            ->maxLength(255),
                        TextInput::make('country')
                            ->maxLength(255),
                        TextInput::make('province')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->maxLength(255),
                    ]),
                Section::make('Professional Data')
                    ->columns(3)
                    ->schema([
                        Select::make('roles')
                            ->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                        Select::make('branche_id')
                            ->relationship('branche', 'name')
                            ->preload()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => $set('department_id', null)),
                        Select::make('department_id')
                            ->options(
                                fn (Get $get): Collection => Department::query()
                                    ->where('id', $get('branche_id'))
                                    ->pluck('name', 'id')
                            )
                            ->searchable()
                            ->preload()
                        //->relationship('user', 'name')
                        ,
                        TextInput::make('charge')
                            ->maxLength(255),
                        DateTimePicker::make('date_in'),
                        TextInput::make('enterprise_mail')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('enterpriser_phone')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('enterpriser_phone_ext')
                            ->label('Extension')
                            ->maxLength(10),
                        Select::make('type_user')
                            ->options([
                                'fixed' => 'Fixed',
                                'external' => 'External'
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('branche.name'),
                TextColumn::make('department.name'),
                TextColumn::make('charge'),
                IconColumn::make('status')
                    ->boolean(),
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
