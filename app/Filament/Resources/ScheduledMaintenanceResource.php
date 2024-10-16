<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScheduledMaintenanceResource\Pages;
use App\Filament\Resources\ScheduledMaintenanceResource\RelationManagers;
use App\Models\ScheduledMaintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScheduledMaintenanceResource extends Resource
{
    protected static ?string $model = ScheduledMaintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ToggleButtons::make('active')
                    ->label('Is active?')
                    ->default(true)
                    ->boolean()
                    ->grouped(),
                Forms\Components\Section::make(__('general.pages.work_order'))
                    ->schema([
                        Forms\Components\ToggleButtons::make('priority')
                            ->label(__('general.form.priority'))
                            ->required()
                            ->options([
                                'high' => __('general.form.high'),
                                'medium' => __('general.form.medium'),
                                'low' => __('general.form.low'),
                            ])
                            ->colors([
                                'high' => 'danger',
                                'medium' => 'warning',
                                'low' => 'success',
                            ])
                            ->icons([
                                'high' => 'heroicon-o-pencil',
                                'medium' => 'heroicon-o-clock',
                                'low' => 'heroicon-o-check-circle',
                            ])
                            ->inline()
                            ->inlineLabel(false)
                            ->default('medium'),
                        Forms\Components\Select::make('site_id')
                            ->label(__('general.pages.site'))
                            ->relationship('site', 'name')
                            ->required(),
                        Forms\Components\Repeater::make('scheduled_maintenance_employee')
                            ->label(__('general.pages.employees'))
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('employee_id')
                                    ->label(__('general.pages.employee'))
                                    ->relationship('employee', 'name')
                                    ->required(),
                                Forms\Components\Checkbox::make('leader')
                                    ->label(__('general.form.leader'))
                                    ->inline()
                                    //->prohibitedIf('leader', false)
                                    ->default(true)
                                    ->fixIndistinctState(),
                            ])
                            ->minItems(1)
                            ->grid(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('description')
                            ->label(__('general.detail.detail'))
                            ->columnSpanFull(),
                    ]),
                Forms\Components\Section::make('')
                    ->columns(2)
                    ->schema([

                        Forms\Components\Select::make('months')
                            ->label(__('general.date.month'))
                            ->multiple()
                            ->options(__('general.date.name_months')),
                        Forms\Components\Checkbox::make('for_days')->inline()
                            ->label(__('general.form.for_number_day'))
                            ->default(false)
                            ->live(),

                        Forms\Components\Select::make('the')
                            ->label(__('general.form.the'))
                            ->hidden(fn(Get $get): bool => $get('for_days'))
                            ->multiple()
                            ->options(__('general.data.ordinal')),
                        Forms\Components\Select::make('days')
                            ->label(__('general.date.day'))
                            ->hidden(fn(Get $get): bool => $get('for_days'))
                            ->multiple()
                            ->options(__('general.date.name_days')),
                        Forms\Components\Select::make('days_num')
                            ->label(__('general.form.number_day'))
                            ->hidden(fn(Get $get): bool => !$get('for_days'))
                            ->multiple()
                            ->options([
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                                '6' => '6',
                                '7' => '7',
                                '8' => '8',
                                '9' => '9',
                                '10' => '10',
                                '11' => '11',
                                '12' => '12',
                                '13' => '13',
                                '14' => '14',
                                '15' => '15',
                                '16' => '16',
                                '17' => '17',
                                '18' => '18',
                                '19' => '19',
                                '20' => '20',
                                '21' => '21',
                                '22' => '22',
                                '23' => '23',
                                '24' => '24',
                                '25' => '25',
                                '26' => '26',
                                '27' => '27',
                                '28' => '28',
                                '29' => '29',
                                '30' => '30',
                                '31' => '31',
                                'last' => __('general.date.last_day'),
                            ]),
                        Forms\Components\Repeater::make('in_day_time')
                            ->label(__('general.form.time_day'))
                            ->simple(
                                Forms\Components\TimePicker::make('time')
                                    ->required(),
                            )
                            ->reorderable(false)
                            ->defaultItems(1)
                            ->minItems(1),
                        Forms\Components\Select::make('type_finished')
                            ->label(__('general.form.type_finished'))
                            ->default('days')
                            ->live()
                            ->options([
                                'time' => __('general.date.time'),
                                'days' => __('general.date.days'),
                            ]),
                        Forms\Components\TimePicker::make('time_finished')
                            ->label(__('general.form.time_finished'))
                            ->hidden(fn(Get $get) => $get('type_finished') == 'days')
                            ->required(fn(Get $get) => $get('type_finished') == 'time')
                            ->seconds(false),
                        Forms\Components\TextInput::make('days_finished')
                            ->label(__('general.form.days_finished'))
                            ->hidden(fn(Get $get) => $get('type_finished') == 'time')
                            ->required(fn(Get $get) => $get('type_finished') == 'days')
                            ->integer(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('in_day_time')
                    ->badge(),
                Tables\Columns\TextColumn::make('days')
                    ->color('success')
                    ->badge(),
                Tables\Columns\TextColumn::make('days_num')
                    ->badge(),
                Tables\Columns\TextColumn::make('the')
                    ->badge(),
                Tables\Columns\TextColumn::make('months')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListScheduledMaintenances::route('/'),
            'create' => Pages\CreateScheduledMaintenance::route('/create'),
            'edit' => Pages\EditScheduledMaintenance::route('/{record}/edit'),
        ];
    }
}
