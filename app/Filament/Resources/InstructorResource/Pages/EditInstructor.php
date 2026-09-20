<?php

namespace App\Filament\Resources\InstructorResource\Pages;

use App\Filament\Resources\InstructorResource;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInstructor extends EditRecord
{
    protected static string $resource = InstructorResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['role'] = User::ROLE_INSTRUCTOR;

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
