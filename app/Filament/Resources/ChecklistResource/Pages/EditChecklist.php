<?php

namespace App\Filament\Resources\ChecklistResource\Pages;

use Filament\Forms;
use App\Models\Service;
use App\Models\Checklist;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Forms\ComponentContainer;
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
            // Action::make('checklists')
            //     ->icon('heroicon-s-cog')
            //     ->color('secondary')
            //     ->mountUsing(fn (Forms\ComponentContainer $form, Checklist $record) => $form->fill([
            //         'services' => []
            //     ]))
            //     ->action(function (Checklist $record, array $data): void {
            //         // Leave blank, Automatic;
            //     })
            //     ->form([
            //         Forms\Components\CheckboxList::make('services')
            //             ->relationship('services', 'name')
            //             ->required(),
            //     ])
            Action::make('checklists')
                ->action(function (Collection $records, array $data) {
                    return redirect(request()->header('Referer'));
                })
                ->mountUsing(fn (Forms\ComponentContainer $form) => $form->fill([]))
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
