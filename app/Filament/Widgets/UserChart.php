<?php

namespace App\Filament\Widgets;

use App\Models\User;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class UserChart extends AdvancedChartWidget
{
    protected static string $color = 'primary';
    protected static ?string $icon = 'icon-students';
    protected static ?string $iconColor = 'info';
    protected static ?string $badgeSize = 'sm';
    protected static ?string $maxHeight = '500px';


    public function getHeading(): string
    {
        return __('إحصائيات المستخدمين');
    }
    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    public function getLabel(): string
    {
        return __('إجمالي المستخدمين حسب النوع');
    }

    protected function getData(): array
    {
        $users = User::where('type', 'user')->count();
        $providers = User::where('type', 'provider')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => [$users, $providers],
                    'backgroundColor' => ['#10B981', '#EF4444'], // أخضر / أحمر
                ],
            ],
            'labels' => ['Users', 'Providers'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // أو 'pie'
    }
}
