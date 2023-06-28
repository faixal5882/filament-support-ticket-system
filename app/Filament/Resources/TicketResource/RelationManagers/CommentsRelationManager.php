<?php

namespace App\Filament\Resources\TicketResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\RelationManagers\RelationManager;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'comment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('comment')
                    ->required()
                    ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('comment'),
                Tables\Columns\TextColumn::make('owner.name')->label('Commented By'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('id', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->hidden(function (RelationManager $livewire) {
                        return $livewire->ownerRecord->status == Ticket::STATUS['Closed'] || $livewire->ownerRecord->status == Ticket::STATUS['Solved'];
                    })
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['user_id'] = auth()->id();

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->hidden(function ($record, RelationManager $livewire) {
                        return $record->user_id != auth()->user()->id || $livewire->ownerRecord->status == Ticket::STATUS['Closed'] || $livewire->ownerRecord->status == Ticket::STATUS['Solved'];
                    }),
                Tables\Actions\DeleteAction::make()
                    ->hidden(function ($record, RelationManager $livewire) {
                        return $record->user_id != auth()->user()->id || $livewire->ownerRecord->status == Ticket::STATUS['Closed'] || $livewire->ownerRecord->status == Ticket::STATUS['Solved'];
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->hidden(!auth()->user()->hasRole('Admin')),
            ]);
    }
}
