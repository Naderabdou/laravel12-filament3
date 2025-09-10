<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard;

class DashboardPage extends Dashboard
{
    protected static ?string $navigationIcon = 'icon-home';

    protected static string $view = 'filament.pages.dashboard';
    protected function getHeaderWidgets(): array
    {
        return [];
    }
}
