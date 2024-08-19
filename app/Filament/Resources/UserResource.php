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
                        Toggle::make('status')
                            ->label(__('general.form.status'))
                            ->default(true),
                        Select::make('blood_type')
                            ->label(__('general.form.blood_type'))
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
                            ->label(__('general.form.drive_license'))
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
                            ->label(__('general.form.cellphone'))
                            ->maxLength(10),
                        TextInput::make('phone')
                            ->label(__('general.form.phone'))
                            ->maxLength(10),
                        TextInput::make('address')
                            ->label(__('general.form.address'))
                            ->maxLength(255),
                        TextInput::make('country')
                            ->label(__('general.form.country'))
                            ->maxLength(255),
                        TextInput::make('province')
                            ->label(__('general.form.province'))
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label(__('general.form.city'))
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
                        Select::make('branche_id')
                            ->relationship('branche', 'name')
                            ->preload()
                            ->searchable()
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('department_id', null)),
                        Select::make('department_id')
                            ->label(__('general.pages.department'))
                            ->disabled(fn(Get $get): bool => $get('branche_id') == null)
                            ->required(fn(Get $get): bool => $get('branche_id') != null)
                            ->options(
                                fn(Get $get): Collection => Department::query()
                                    ->where('id', $get('branche_id'))
                                    ->pluck('name', 'id')
                            ),
                        TextInput::make('charge')
                            ->label(__('general.form.charge'))
                            ->maxLength(255),
                        DateTimePicker::make('date_in')
                            ->label(__('general.date.date_in')),
                        TextInput::make('enterprise_mail')
                            ->label(__('general.form.enterprise_mail'))
                            ->email()
                            ->maxLength(255),
                        TextInput::make('enterpriser_phone')
                            ->label(__('general.form.enterprise_phone'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('enterpriser_phone_ext')
                            ->label(__('general.form.enterprise_phone_ext'))
                            ->maxLength(10),
                        Select::make('type_user')
                            ->label(__('general.form.type_employee'))
                            ->options([
                                'fixed' => __('general.select.fixed'),
                                'external' => __('general.select.external')
                            ]),
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
                TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    ->searchable(),
                TextColumn::make('department.name')
                    ->label(__('general.pages.department'))
                    ->searchable(),
                TextColumn::make('charge')
                    ->label(__('general.form.charge'))
                    ->searchable(),
                IconColumn::make('status')
                    ->label(__('general.form.status'))
                    ->sortable()
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
