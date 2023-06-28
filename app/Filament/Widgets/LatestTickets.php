<?php

namespace App\Filament\Widgets;

use Closure;
use App\Models\Role;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTickets extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        $ticketQuery = Ticket::query()
            ->latest()
            ->limit(5);

        return auth()->user()->hasRole(Role::ROLES['Admin']) ?  $ticketQuery : $ticketQuery->where('assigned_to', auth()->id());
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('client.name')
                ->sortable()
                ->description(fn (Ticket $record): string => $record?->description ?? ''),
            TextColumn::make('country.name'),
            BadgeColumn::make('status')
                ->sortable()
                ->colors([
                    'warning' => Ticket::STATUS['Solved'],
                    'success' => Ticket::STATUS['Closed'],
                    'danger' => Ticket::STATUS['Open'],
                ])
                ->enum(Ticket::STATUS),
            BadgeColumn::make('priority')
                ->sortable()
                ->colors([
                    'warning' => Ticket::PRIORITY['Medium'],
                    'success' => Ticket::PRIORITY['Low'],
                    'danger' => Ticket::PRIORITY['High'],
                ])
                ->enum(Ticket::PRIORITY),
            TextColumn::make('assignedTo.name'),
            TextColumn::make('assignedBy.name'),
            TextColumn::make('created_at')
                ->sortable()
                ->dateTime(),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
