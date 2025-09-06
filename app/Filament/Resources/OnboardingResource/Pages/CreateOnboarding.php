<?php

namespace App\Filament\Resources\OnboardingResource\Pages;

use App\Filament\Resources\OnboardingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOnboarding extends CreateRecord
{
    protected static string $resource = OnboardingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Onboarding Created Successfully');
    }
}
