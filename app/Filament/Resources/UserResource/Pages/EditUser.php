<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Action::make('updatePassword')
                ->label('Update Password')
                ->action(function (array $data): void {
                    $this->record->update([
                        'password' => Hash::make($data['password']),
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Password Updated Successfully')
                        ->send();
                })
                ->form([
                    TextInput::make('password')
                        ->password()
                        ->confirmed()
                        ->disableAutocomplete(),
                    TextInput::make('password_confirmation')
                        ->password()
                        ->disableAutocomplete(),
                ]),
        ];
    }
}
