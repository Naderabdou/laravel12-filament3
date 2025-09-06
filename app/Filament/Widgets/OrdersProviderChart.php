<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\ProviderSubscription;
use EightyNine\FilamentAdvancedWidget\AdvancedChartWidget;

class OrdersProviderChart extends AdvancedChartWidget
{
    protected static string $color = 'success';
    protected static ?string $icon = 'heroicon-o-shopping-cart';
    protected static ?string $iconColor = 'primary';
    protected static ?string $iconBackgroundColor = 'white';

    public ?string $filter = 'today';

    public function getHeading(): string
    {
        return __('إحصائيات الطلبات');
    }

    public function getLabel(): string
    {
        return __('عدد الطلبات حسب الفترة المختارة');
    }

    protected function getFilters(): ?array
    {
        return [
            'today' => 'اليوم',
            'week' => 'الأسبوع الحالي',
            'month' => 'الشهر الحالي',
            'year' => 'السنة الحالية',
        ];
    }

    protected function getData(): array
    {
        $query = ProviderSubscription::query();

        $labels = [];
        $data = [];

        switch ($this->filter) {
            case 'today':
                $start = Carbon::today();
                $query->whereDate('created_at', $start);

                $orders = $query->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                    ->groupBy('hour')
                    ->pluck('count', 'hour');

                for ($i = 0; $i < 24; $i++) {
                    $labels[] = "$i:00";
                    $data[] = $orders[$i] ?? 0;
                }
                break;

            case 'week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();

                $query->whereBetween('created_at', [$start, $end]);

                $orders = $query->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
                    ->groupBy('day')
                    ->pluck('count', 'day');

                $weekdays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                foreach ($weekdays as $i => $dayName) {
                    $labels[] = $dayName;
                    $data[] = $orders[$i + 1] ?? 0;
                }
                break;

            case 'month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();

                $query->whereBetween('created_at', [$start, $end]);

                $orders = $query->selectRaw('DAY(created_at) as day, COUNT(*) as count')
                    ->groupBy('day')
                    ->pluck('count', 'day');

                $daysInMonth = now()->daysInMonth;

                for ($i = 1; $i <= $daysInMonth; $i++) {
                    $labels[] = (string)$i;
                    $data[] = $orders[$i] ?? 0;
                }
                break;

            case 'year':
            default:
                $query->whereYear('created_at', now()->year);

                $orders = $query->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month');

                $months = [
                    1 => 'Jan',
                    2 => 'Feb',
                    3 => 'Mar',
                    4 => 'Apr',
                    5 => 'May',
                    6 => 'Jun',
                    7 => 'Jul',
                    8 => 'Aug',
                    9 => 'Sep',
                    10 => 'Oct',
                    11 => 'Nov',
                    12 => 'Dec',
                ];

                foreach ($months as $num => $name) {
                    $labels[] = $name;
                    $data[] = $orders[$num] ?? 0;
                }
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'عدد الطلبات',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
