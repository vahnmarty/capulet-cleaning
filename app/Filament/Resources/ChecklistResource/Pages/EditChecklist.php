<?php

namespace App\Filament\Resources\ChecklistResource\Pages;

use Filament\Forms;
use App\Models\Service;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\ChecklistResource;

class EditChecklist extends EditRecord
{
    protected static string $resource = ChecklistResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('checklists')
                ->action(function (Collection $records, array $data): void {
                    //return redirect('');
                })
                ->form([
                    Forms\Components\CheckboxList::make('services')
                        ->label('Services')
                        ->relationship('services', 'name')
                        ->options(Service::orderBy('name')->get()->pluck('name', 'id'))
                        ->required(),
                ])
        ];
    }
}
