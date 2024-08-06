<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccessResource\Pages;
use App\Filament\Resources\AccessResource\RelationManagers;
use App\Models\Access;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class AccessResource extends Resource
{
    protected static ?string $model = Access::class;

    protected static ?string $navigationIcon = 'heroicon-m-clipboard-document-check';

    public static function getModelLabel(): string
    {
        return __('general.access');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.accesses');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.accesses');
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
                    //->default(Auth::user()->branche_id)
                    ->relationship('branche', 'name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->autofocus()
                    ->relationship('user','name')
                    ->searchable(['name','ci'])
                    //->getSearchResultsUsing(function (string $search,Forms\Set $set) {
                    //    //dd();
                    //    $user = User::select('id')->where('name', 'like', "%{$search}%")->limit(5)->pluck('id')->first();
                    //    //dd(Auth::user()->branche_id);
                    //    if ($user != null) {
                    //        $access = new Access();
                    //        $access['user_id'] = $user;
                    //        $access['branche_id'] = Auth::user()->branche_id;
                    //        $access['date_time_in'] = Carbon::now();
                    //        $access->save();
                    //        
                    //        return [$user => $search];
                    //    }
                    //    $set('user_id',null);
                    //    $search=null;
                    //    return [];
                    //})
                    //->afterStateUpdated(function (Forms\Set $set) {
                    //    
                    //})
                    //->searchDebounce(500)
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_in')
                    ->default(Carbon::now())
                    ->required(),
                Forms\Components\DateTimePicker::make('date_time_out'),
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
                Tables\Columns\TextColumn::make('date_time_in')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time_out')
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
            'index' => Pages\ListAccesses::route('/'),
            'create' => Pages\CreateAccess::route('/create'),
            'view' => Pages\ViewAccess::route('/{record}'),
            'edit' => Pages\EditAccess::route('/{record}/edit'),
        ];
    }
}
