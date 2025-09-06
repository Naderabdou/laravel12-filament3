<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;
use App\Filament\Widgets\UserChart;
use App\Filament\Widgets\ProviderChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\OrdersUserChart;
use App\Filament\Widgets\OrdersProviderChart;

class DashboardPage extends Dashboard
{
    protected static ?string $navigationIcon = 'icon-home';

    protected static string $view = 'filament.pages.dashboard';
    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class, // Add your custom widget here
            OrdersUserChart::class, // Add your custom widget here
            OrdersProviderChart::class, // Add your custom widget here
            UserChart::class, // Add your custom widget here
            // ProviderChart::class, // Add your custom widget here
        ];
    }
}
