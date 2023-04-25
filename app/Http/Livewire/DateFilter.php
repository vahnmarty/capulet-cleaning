<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Closure;
use Str;

class DateFilter extends Component implements HasForms
{
    use InteractsWithForms;

    public $filter = 'last_7_days';
    
    public function render()
    {
        return view('livewire.date-filter');
    }

    public function getFormSchema()
    {
        return [
            Select::make('filter')->options([
                'last_7_days' => 'Last 7 days',
                'last_30_days' => 'Last 30 days',
                'last_90_days' => 'Last 90 Days',
                'last_6_months' => 'Last 6 months',
                'this_year' => 'This Year',
                'last_year' => 'Last Year'
            ])
            ->afterStateUpdated(function (Closure $set, $state) {
                $this->emit('updateFilter', $state);
            })
            ->reactive()
            ->disableLabel()
            ->placeholder('Active Filter')
        ];
    }
}
