<?php

namespace App\Filament\Resources\TicketResource\Pages;

use App\Models\Role;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TicketResource;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return auth()->user()->hasRole(Role::ROLES['Admin']) ?  parent::getTableQuery() : parent::getTableQuery()->where(function ($query) {
            $query->where('assigned_to', auth()->id())
                ->orWhere('assigned_by', auth()->id());
        });
    }
}
