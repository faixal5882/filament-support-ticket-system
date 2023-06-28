<?php

namespace App\Filament\Resources\CountryResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CountryResource;

class EditCountry extends EditRecord
{
    protected static string $resource = CountryResource::class;

    protected function getActions(): array
    {
        return [
            //
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
