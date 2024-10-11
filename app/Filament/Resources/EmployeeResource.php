<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
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
use Illuminate\Support\Facades\Auth;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    //protected static ?int $navigationSort = 36;
    public static function getModelLabel(): string
    {
        return __('general.pages.employee');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.pages.employees');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.pages.employee');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.my_organization');
    }
    //public static function getEloquentQuery(): Builder
    //{
    //    return parent::getEloquentQuery()->where('id', '!=', 1)->orderBy('id', 'DESC');
    //}
    public static function getPermissionPrefixes(): array
    {
        return [
            'view',
            'view_any',
            'create',
            'update',
            'delete',
            'delete_any',
            'publish'
        ];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->relationship(
                        'user',
                    )
                    ->columnSpanFull()
                    ->columns(4)
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->label(__('general.form.photo', ['number' => '']))
                            ->directory('users')
                            ->avatar(),
                        TextInput::make('name')
                            ->label(__('general.form.user'))
                            ->live()
                            //->default(fn(Get $get) => $get('ci'))
                            ->disabled(),
                        TextInput::make('password')
                            ->label(__('general.form.password'))
                            ->password()
                            ->required()
                            ->hiddenOn('edit'),
                        Select::make('roles')
                            //->multiple()
                            ->relationship('roles', 'name')
                            ->preload()
                            ->searchable(),
                    ]),
                Section::make(__('general.data.data_employee'))
                    ->columns(3)
                    ->schema([
                        Toggle::make('status')
                            ->label(__('general.form.status'))
                            ->default(true),
                        TextInput::make('email')
                            ->label(__('general.form.mail'))
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('name')
                            ->label(__('general.form.name'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('ci')
                            ->label(__('general.form.ci'))
                            ->required()
                            //->live()
                            ->afterStateUpdated(fn(Set $set, Get $get,$state) => $set('user.name', $state))
                            ->maxLength(10),
                        Select::make('blood_type')
                            ->label(__('general.form.blood_type'))
                            //->default('O+')
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
                        Select::make('branche_id')
                            ->label(__('general.pages.branche'))
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
                            )
                        //->searchable()
                        //->preload()
                        //->relationship('user', 'name')
                        ,
                        Select::make('charge')
                            ->label(__('general.form.charge'))
                            ->options([
                                'admin' => __('general.form.admin'),
                                'boss' => __('general.form.boss'),
                                'guard_user' => __('general.form.guard_user'),
                                'employee' => __('general.form.employee'),
                                'maintenance_user' => __('general.form.maintenance_user')
                            ]),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployee::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
