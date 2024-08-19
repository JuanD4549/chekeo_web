<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ControlSupervisoryResource\Pages;
use App\Filament\Resources\ControlSupervisoryResource\RelationManagers;
use App\Models\CheckSupervisory;
use App\Models\ControlSupervisory;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ControlSupervisoryResource extends Resource
{
    protected static ?string $model = ControlSupervisory::class;

    protected static ?string $navigationIcon = 'icon-check-people';

    public static function getModelLabel(): string
    {
        return __('general.pages.control_supervisory');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.control_supervisory');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.control_supervisory');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('')
                    ->schema([
                        Forms\Components\Select::make('branche_id')
                            ->label(__('general.pages.branche'))
                            ->relationship('branche', 'name')
                            ->disabledOn('edit')
                            ->required(),
                        Forms\Components\Select::make('user_id')
                            ->label(__('general.pages.employee'))
                            ->label(__('general.pages.employee'))
                            ->relationship('user', 'name')
                            ->disabledOn('edit')
                            ->required(),
                    ]),
                Forms\Components\Section::make(__('general.form.control_place'))
                    ->columnSpanFull()
                    ->schema([
                        Forms\Components\Repeater::make('detail_control_supervisories')
                            ->label('')
                            ->relationship('detail_control_supervisories')
                            ->disabledOn('edit')
                            //->disabled(true)
                            ->schema([
                                Forms\Components\Select::make('place_id')
                                    ->label(__('general.pages.place'))
                                    ->relationship('place', 'name')
                                    ->required(),
                                Forms\Components\CheckboxList::make('list_checked')
                                    ->label(__('general.form.list_check'))
                                    ->options(fn() => CheckSupervisory::pluck('name', 'id')),
                            ])
                            ->addActionLabel(__('general.add.add_place'))
                            //->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->grid(3),
                    ]),

                Forms\Components\Section::make('')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->schema([
                        Forms\Components\DateTimePicker::make('date_time_closed')
                            ->label(__('general.date.date_time_closing'))
                            ->default(Carbon::now()),
                        Forms\Components\Textarea::make('detail_closed')
                            ->label(__('general.detail.detail_closed'))
                            //->hiddenOn('create')
                            ->columnSpanFull(),
                    ])
                    ->hiddenOn('create'),

                //Forms\Components\TextInput::make('list_checked'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->label(__('general.pages.branche'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.pages.employee'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_closed')
                ->label(__('general.date.date_time_closing'))
                    ->label(__('general.date.date_time_closing'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.table.created_at'))
                    ->label(__('general.table.created_at'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('general.table.updated_at'))
                    ->label(__('general.table.updated_at'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListControlSupervisories::route('/'),
            'create' => Pages\CreateControlSupervisory::route('/create'),
            'view' => Pages\ViewControlSupervisory::route('/{record}'),
            'edit' => Pages\EditControlSupervisory::route('/{record}/edit'),
        ];
    }
}
