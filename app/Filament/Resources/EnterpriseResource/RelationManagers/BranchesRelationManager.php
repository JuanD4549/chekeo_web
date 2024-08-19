<?php

namespace App\Filament\Resources\EnterpriseResource\RelationManagers;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class BranchesRelationManager extends RelationManager
{
    protected static string $relationship = 'branches';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('general.pages.branches');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('general.form.name'))
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('user_id')
                    ->label(__('general.form.boss'))
                    ->options(
                        fn(): Collection => User::query()
                            ->where('charge', 'Boss')
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    //->relationship('user', 'name')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('general.form.name')),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('general.form.boss')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label(__('general.create.branche')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
