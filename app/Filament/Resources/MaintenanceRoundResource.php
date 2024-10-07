<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceRoundResource\Pages;
use App\Filament\Resources\MaintenanceRoundResource\RelationManagers;
use App\Models\Element;
use App\Models\MaintenanceRound;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceRoundResource extends Resource
{
    protected static ?string $model = MaintenanceRound::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('general.pages.maintenance_round');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.maintenance_rounds');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.maintenance_rounds');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.maintenance');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->label(__('general.pages.employee'))
                    ->relationship('employee', 'name')
                    ->disabledOn('edit')
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Repeater::make('maintenance_round_details')
                    ->label(__('general.pages.maintenance_round_details'))
                    ->relationship()
                    ->columnSpanFull()
                    ->reorderable(false)
                    ->deletable(false)
                    ->schema([
                        Forms\Components\Select::make('site_id')
                            ->label(__('general.pages.site'))
                            ->relationship('site', 'name')
                            ->live()
                            ->required(),
                        Forms\Components\Repeater::make('element_detail')
                            ->label(__('general.pages.element_detail'))
                            ->relationship()
                            ->reorderable(false)
                            ->deletable(false)
                            ->hidden(function (Get $get): bool {
                                $site_id = $get('site_id');
                                if ($site_id != null) {
                                    //dd($site_id);
                                    $elements = Element::where('site_id', $site_id)
                                        ->count();
                                    if ($elements > 0) {
                                        return false;
                                    }
                                    return true;
                                } else {
                                    return true;
                                }
                            })
                            ->schema([
                                Forms\Components\Split::make([
                                    Forms\Components\Select::make('element_id')
                                        ->label(__('general.pages.element'))
                                        //->relationship('site', 'name')
                                        ->options(function (Get $get): array {
                                            $site_id = $get('../../site_id');
                                            if ($site_id != null) {
                                                //dd($site_id);
                                                $elements = Element::where('site_id', $site_id)
                                                    ->pluck('name', 'id')->toArray();
                                                return $elements;
                                            } else {
                                                return [];
                                            }
                                        })
                                        ->grow(false)
                                        ->columnSpan(1)
                                        ->required(),
                                    Forms\Components\ToggleButtons::make('status')
                                        ->label(__('general.form.status'))
                                        //->label('Like this post?')
                                        ->boolean(__('general.form.ok'), __('general.form.bad'))
                                        ->default(true)
                                        ->grow(false)
                                        ->grouped(),
                                    Forms\Components\Textarea::make('detail')
                                        ->label(__('general.detail.detail'))
                                        ->rows(1)
                                        ->columnSpanFull(),
                                ])->from('md'),

                            ])
                            ->maxItems(function (Get $get): int {
                                $site_id = $get('site_id');
                                if ($site_id != null) {
                                    //dd($site_id);
                                    $elements = Element::where('site_id', $site_id)->count();
                                    return $elements;
                                } else {
                                    return 0;
                                }
                            }),
                    ])
                    ->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->label(__('general.pages.employee'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('maintenance_round_details.site.name')
                    ->label(__('general.pages.site'))
                    ->badge()
                    ->searchable(),
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
            'index' => Pages\ListMaintenanceRounds::route('/'),
            'create' => Pages\CreateMaintenanceRound::route('/create'),
            'view' => Pages\ViewMaintenanceRound::route('/{record}'),
            'edit' => Pages\EditMaintenanceRound::route('/{record}/edit'),
        ];
    }
}
