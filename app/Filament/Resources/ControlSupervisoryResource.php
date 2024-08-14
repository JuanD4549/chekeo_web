<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ControlSupervisoryResource\Pages;
use App\Filament\Resources\ControlSupervisoryResource\RelationManagers;
use App\Models\CheckSupervisory;
use App\Models\ControlSupervisory;
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
        return __('general.control_supervisory');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.control_supervisories');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.control_supervisories');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('branche_id')
                    ->relationship('branche', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_closed'),
                Forms\Components\Textarea::make('detail_closed')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('detail_control_supervisories')
                    ->relationship('detail_control_supervisories')
                    //->disabled(true)
                    ->schema([
                        Forms\Components\Select::make('place_id')
                        ->relationship('place', 'name')
                        ->required(),
                        Forms\Components\CheckboxList::make('list_checked')
                            ->options(fn() => CheckSupervisory::pluck('name', 'id')),
                    ])
                    ->addActionLabel('Add point')
                    //->addable(false)
                    ->deletable(false)
                    ->reorderable(false)
                    ->grid(2),
                //Forms\Components\TextInput::make('list_checked'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('branche.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_closed')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListControlSupervisories::route('/'),
            'create' => Pages\CreateControlSupervisory::route('/create'),
            'view' => Pages\ViewControlSupervisory::route('/{record}'),
            'edit' => Pages\EditControlSupervisory::route('/{record}/edit'),
        ];
    }
}
