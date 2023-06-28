<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Category;
use App\Models\Client;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getCards(): array
    {
        return [
            Card::make('Total Tickets', Ticket::count()),
            Card::make('Total Staffs', User::whereHas('roles', function ($query) {
                $query->where('title', Role::ROLES['Staff']);
            })->count()),
            Card::make('Total Categories', Category::count()),
            Card::make('Total Clients', Client::count()),
        ];
    }
}
