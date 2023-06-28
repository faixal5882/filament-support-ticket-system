<?php

namespace App\Filament\Resources\CountryResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\CountryResource;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
