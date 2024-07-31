<?php

namespace App\Filament\Resources;

use App\Filament\Funcions\Logica;
use App\Filament\Resources\DataSecurityGuardShiftResource\Pages;
use App\Filament\Resources\DataSecurityGuardShiftResource\RelationManagers;
use App\Forms\Components\Latitude;
use App\Forms\Components\LatLon;
use App\Forms\Components\Longitude;
use App\Forms\Components\WebCam;
use App\Livewire\WebCamForm;
use App\Models\DataSecurityGuardShift;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\ViewField;
use Illuminate\Database\Eloquent\Model;

class DataSecurityGuardShiftResource extends Resource
{
    protected static ?string $model = DataSecurityGuardShift::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    public static function getModelLabel(): string
    {
        return __('general.turn');
    }
    public static function getPluralModelLabel(): string
    {
        return __('general.turns');
    }
    public static function getNavigationLabel(): string
    {
        return __('general.turn');
    }
    public static function getNavigationGroup(): ?string
    {
        return __('general.menu.security');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Data Primary')
                    ->relationship(
                        'security_guard_shift',
                    )
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->noSearchResultsMessage('No users found.')
                            ->required(),
                        Forms\Components\Select::make('branche_id')
                            ->relationship('branche', 'name')
                            ->noSearchResultsMessage('No branches found.')
                            ->required(),
                        Forms\Components\Toggle::make('relief')
                            ->required(),
                        Forms\Components\Toggle::make('status')
                            ->required(),
                    ])
                    ->hidden((new Logica)->getIdSecurityGuardShifts() == 0 ? false : true),
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->default('in'),
                Forms\Components\DateTimePicker::make('date_time')
                    //->default(Carbon::now())
                    ->required(),
                Forms\Components\Textarea::make('detail')
                    ->columnSpanFull(),
                Latitude::make('latitude'),
                Longitude::make('longitude'),
                WebCam::make('img1_url')
                ->hiddenOn('view')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('security_guard_shift.user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('security_guard_shift.status')
                    ->label('Satus')
                    ->boolean(),
                Tables\Columns\IconColumn::make('security_guard_shift.relief')
                    ->label('Relief')
                    ->boolean(),
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
                Tables\Actions\EditAction::make()
                ->hidden(fn(Model $record)=>$record->created_at!=null?true:false),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDataSecurityGuardShifts::route('/'),
            'create' => Pages\CreateDataSecurityGuardShift::route('/create'),
            'edit' => Pages\EditDataSecurityGuardShift::route('/{record}/edit'),
            'view' => Pages\ViewDataSecurityGuardShift::route('/{record}'),
        ];
    }
}
