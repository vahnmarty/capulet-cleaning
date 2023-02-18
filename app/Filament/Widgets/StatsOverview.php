<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Property;
use App\Models\Checklist;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Bookings', Booking::count())->icon('heroicon-o-calendar'),
            Card::make('Properties', Property::count())->icon('heroicon-o-collection'),
            Card::make('Checklist', Checklist::count())->icon('heroicon-o-clipboard-check'),
        ];
    }
}
