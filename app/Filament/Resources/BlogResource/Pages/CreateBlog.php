<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Enums\BlogType;
use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Blog Created Successfully');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = BlogType::BLOG;

        return $data;
    }
}
