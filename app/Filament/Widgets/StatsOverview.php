<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\UserSubscription;
use App\Models\ProviderSubscription;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget\Stat;
use EightyNine\FilamentAdvancedWidget\AdvancedStatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected ?array $cachedData = null;

    protected function getStats(): array
    {
        $data = $this->getCachedData();

        return [
            Stat::make(__('Total Users'), $data['progressUserCount'] . ' ')->icon('icon-students')
                ->progress($data['progressuUser'])
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Users'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

            Stat::make(__('Total Orders User'), $data['progressOrderUserCount'] . ' ')->icon('icon-box')
                ->progress($data['progressOrderUser'])
                ->progressBarColor('warning')
                ->chartColor('warning')
                ->description(__('Total Orders User'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('warning')
                ->iconColor('warning')
                ->iconPosition('start'),

            Stat::make(__('Total Providers'), $data['progressuProviderCount'] . ' ')->icon('icon-provider')
                ->progress($data['progressuProvider'])
                ->progressBarColor('primary')
                ->chartColor('primary')
                ->description(__('Total Providers'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('primary')
                ->iconColor('primary')
                ->iconPosition('start'),

            Stat::make(__('Total Orders Provider'), $data['progressOrderProviderCount'] . ' ')->icon('icon-box')
                ->progress($data['progressOrderProvider'])
                ->progressBarColor('danger')
                ->chartColor('danger')
                ->description(__('Total Orders Provider'))
                ->descriptionIcon('heroicon-o-chevron-up', 'before')
                ->descriptionColor('danger')
                ->iconColor('danger')
                ->iconPosition('start'),
        ];
    }

    protected function getData(): array
    {
        $userCount = User::where('type', 'user')->count();
        $providerCount = User::where('type', 'provider')->count();
        $orderProviderCount = ProviderSubscription::count();
        $orderUserCount = UserSubscription::count();

        return [
            'progressuUser' => min($userCount, 100),
            'progressUserCount' => $userCount,
            'progressuProvider' => min($providerCount, 100),
            'progressuProviderCount' => $providerCount,
            'progressOrderProvider' => min($orderProviderCount, 100),
            'progressOrderProviderCount' => $orderProviderCount,
            'progressOrderUser' => min($orderUserCount, 100),
            'progressOrderUserCount' => $orderUserCount,
        ];
    }


    protected function getCachedData(): array
    {
        return $this->cachedData ??= $this->getData();
    }
}
