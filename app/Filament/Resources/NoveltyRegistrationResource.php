<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoveltyRegistrationResource\Pages;
use App\Filament\Resources\NoveltyRegistrationResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\Longitude;
use App\Models\CatalogNovelty;
use App\Models\Novelty;
use App\Models\NoveltyRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoveltyRegistrationResource extends Resource
{
    protected static ?string $model = NoveltyRegistration::class;

    protected static ?string $navigationIcon = 'icon-new-2';

    public static function getModelLabel(): string
    {
        return __('general.pages.novelty');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.novelties');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.novelties');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.security');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //Forms\Components\Split::make([
                Forms\Components\Section::make([
                    Forms\Components\Select::make('branche_id')
                        ->relationship('branche', 'name')
                        ->label(__('general.pages.branche'))
                        ->disabledOn('edit')
                        ->required(),
                    Forms\Components\Select::make('user_id')
                        ->label(__('general.pages.employee'))
                        ->relationship('user', 'name')
                        ->disabledOn('edit')
                        ->required(),
                ])->columns(2),
                Forms\Components\Section::make([
                    Forms\Components\Select::make('novelty_id')
                        //->relationship('novelties', 'name')
                        ->label(__('general.select.select_novelty'))
                        ->disabledOn('edit')
                        ->options(function () {
                            $catalogo_novelty = CatalogNovelty::where('name', 'Seguridad')->first();
                            return Novelty::where('catalog_novelty_id', $catalogo_novelty->id ?? 0)->pluck('name', 'id');
                        })
                        ->required(),
                    Forms\Components\Select::make('user_notificad_id')
                        ->label(__('general.form.notify_to'))
                        ->relationship('user_notificad', 'name')
                        ->disabledOn('edit')
                        ->required(),
                    Forms\Components\Fieldset::make(__('general.gps.location'))
                        ->schema([
                            Latitude::make('latitude')
                                ->label(__('general.gps.latitude'))
                                ->disabledOn('edit'),
                            Longitude::make('longitude')
                                ->label(__('general.gps.longitude'))
                                ->disabledOn('edit'),
                        ]),

                    Forms\Components\Textarea::make('detail_created')
                        ->label(__('general.detail.detail'))
                        ->columnSpanFull()
                        ->required()
                        ->disabledOn('edit'),
                ])->columns(2),
                //])
                // ->from('md')
                //->columnSpanFull(),

                Forms\Components\Section::make(__('general.form.images'))
                    ->columns(2)
                    ->schema([
                        Forms\Components\FileUpload::make('img1_url')
                            ->label(__('general.form.image', ['number' => '#1']))
                            ->disabledOn('edit')
                            ->image(),
                        Forms\Components\FileUpload::make('img2_url')
                            ->label(__('general.form.image', ['number' => '#2']))
                            ->disabledOn('edit')
                            ->image(),

                        Forms\Components\FileUpload::make('img3_url')
                            ->label(__('general.form.image', ['number' => '#3']))
                            ->disabledOn('edit')
                            ->image(),

                        Forms\Components\FileUpload::make('img4_url')
                            ->label(__('general.form.image', ['number' => '#4']))
                            ->disabledOn('edit')
                            ->image(),
                    ]),

                Forms\Components\Section::make('')
                    //->description('Prevent abuse by limiting the number of requests per period')
                    ->hiddenOn('create')
                    ->schema([
                        Forms\Components\DateTimePicker::make('date_time_close')
                            ->label(__('general.date.date_time_closing')),
                        Forms\Components\Textarea::make('detail_closed')
                            ->label(__('general.detail.detail_closing'))
                            ->columnSpanFull(),
                    ]),
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
                Tables\Columns\TextColumn::make('user_notificad.name')
                    ->label(__('general.form.notify_to'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('novelty.name')
                    ->label(__('general.pages.novelty'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_close')
                    ->label(__('general.date.date_time_closing'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('general.table.created_at'))
                    ->dateTime('H:i:s / d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListNoveltyRegistrations::route('/'),
            'create' => Pages\CreateNoveltyRegistration::route('/create'),
            'view' => Pages\ViewNoveltyRegistration::route('/{record}'),
            'edit' => Pages\EditNoveltyRegistration::route('/{record}/edit'),
        ];
    }
}
