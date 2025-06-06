<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\OrderHeader;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderHeaderResource\Pages;
use App\Filament\Resources\OrderHeaderResource\RelationManagers;

class OrderHeaderResource extends Resource
{
    protected static ?string $model = OrderHeader::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DateTimePicker::make('tgl_order')
                    ->required(),
                Forms\Components\TextInput::make('member_id')
                    ->required()
                    ->numeric()
                    ->hiddenOn(Pages\EditOrderHeader::class),
                Select::make('status')
                    ->options([
                        'new' => 'New',
                        'processed' => 'Processed',
                        'done' => 'Done',
                    ])->required(),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tgl_order')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('member.fullname')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->badge(),

                Tables\Columns\TextColumn::make('jenis_pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('payment_id')
                //     ->numeric()
                //     ->sortable(),
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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListOrderHeaders::route('/'),
            'create' => Pages\CreateOrderHeader::route('/create'),
            'edit' => Pages\EditOrderHeader::route('/{record}/edit'),
        ];
    }
}
