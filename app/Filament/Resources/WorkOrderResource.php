<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkOrderResource\Pages;
use App\Filament\Resources\WorkOrderResource\RelationManagers;
use App\Models\WorkOrder;
use App\Models\WorkOrderDetail;
use DateTime;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkOrderResource extends Resource
{
    protected static ?string $model = WorkOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('general.pages.work_order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('general.pages.work_orders');
    }

    public static function getNavigationLabel(): string
    {
        return __('general.pages.work_orders');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('general.menu_category.maintenance');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ToggleButtons::make('priority')
                    ->label(__('general.form.priority'))
                    ->disabledOn('edit')
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
                    ->disabledOn('edit')
                    ->relationship('site', 'name')
                    ->required(),
                Forms\Components\Repeater::make('user_work_order')
                    ->label(__('general.pages.employees'))
                    ->disabledOn('edit')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label(__('general.pages.employee'))
                            ->relationship('user', 'name')
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
                    ->disabledOn('edit')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('img1_url')
                    ->label(__('general.form.photo', ['number' => '1']))
                    ->disabledOn('edit')
                    ->directory('work_orders'),
                Forms\Components\FileUpload::make('img2_url')
                    ->label(__('general.form.photo', ['number' => '2']))
                    ->disabledOn('edit')
                    ->directory('work_orders'),
                Forms\Components\Repeater::make('work_order_details')
                    ->label(__('general.pages.work_order_details'))
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('advance')
                            ->label(__('general.form.advance'))
                            ->numeric()
                            ->step(5)
                            ->minValue(0)
                            ->maxValue(100),
                        Forms\Components\Textarea::make('detail')
                            ->label(__('general.detail.detail'))
                            ->required(),
                        Forms\Components\FileUpload::make('img1_url')
                            ->label(__('general.form.photo', ['number' => '1']))
                            ->directory('work_orders'),
                        Forms\Components\FileUpload::make('img2_url')
                            ->label(__('general.form.photo', ['number' => '2']))
                            ->directory('work_orders'),
                    ])
                    ->hiddenOn('create')
                    ->grid(2)
                    ->minItems(1)
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('date_time_closed')
                    ->hiddenOn(['create', 'edit']),
                Forms\Components\Textarea::make('description_closed')
                    ->hiddenOn(['create', 'edit'])
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('img3_url')
                    ->label(__('general.form.photo', ['number' => '1']))
                    ->hiddenOn(['create', 'edit'])
                    ->directory('work_orders'),
                Forms\Components\FileUpload::make('img4_url')
                    ->label(__('general.form.photo', ['number' => '2']))
                    ->hiddenOn(['create', 'edit'])
                    ->directory('work_orders'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('site.name')
                    ->label(__('general.pages.place'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('priority')
                    ->label(__('general.form.priority'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => __("general.form.{$state}"))
                    ->color(fn(string $state): string => match ($state) {
                        'high' => 'danger',
                        'medium' => 'warning',
                        'low' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('state')
                    ->label(__('general.form.state'))
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => __("general.form.{$state}"))
                    ->color(fn(string $state): string => match ($state) {
                        'started' => 'danger',
                        'in_process' => 'warning',
                        'completed' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_work_order.user.name')
                    ->badge(),
                //->formatStateUsing(function (WorkOrder $record): string {
                //    return $record->user_work_order->where('leader', true);
                //}),
                Tables\Columns\TextColumn::make('date_time_closed')
                    ->label(__('general.date.date_time_closed'))
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
                Tables\Actions\EditAction::make()
                    ->hidden(fn(WorkOrder $record): bool => $record->date_time_closed != null ? true : false),
                Tables\Actions\Action::make('closed')
                    ->hidden(fn(WorkOrder $record): bool => $record->date_time_closed != null ? true : false)
                    ->requiresConfirmation()
                    ->form([
                        Forms\Components\Textarea::make('description_closed')
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('img3_url')
                            ->directory('work_orders'),
                        Forms\Components\FileUpload::make('img4_url')
                            ->directory('work_orders'),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['date_time_closed'] = new  DateTime();
                        return $data;
                    })
                    ->action(function (array $data, WorkOrder $record) {
                        $record['date_time_closed'] = $data['date_time_closed'];
                        $record['description_closed'] = $data['description_closed'];
                        $record['img3_url'] = $data['img3_url'];
                        $record['img4_url'] = $data['img4_url'];
                        $record['state'] = 'completed';
                        $record->save();
                    })
                    ->slideOver(),
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
            'index' => Pages\ListWorkOrders::route('/'),
            'create' => Pages\CreateWorkOrder::route('/create'),
            'view' => Pages\ViewWorkOrder::route('/{record}'),
            'edit' => Pages\EditWorkOrder::route('/{record}/edit'),
        ];
    }
}
