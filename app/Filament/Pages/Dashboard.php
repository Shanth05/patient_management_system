<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Admin\Widgets\StatsOverview;


class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Admin\Widgets\StatsOverview::class,
        ];
    }

    protected static ?string $title = 'Clinic Dashboard';
}
