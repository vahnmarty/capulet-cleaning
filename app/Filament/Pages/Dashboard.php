<?php
 
namespace App\Filament\Pages;
 
use Illuminate\View\View;
use Filament\Pages\Dashboard as BasePage;
 
class Dashboard extends BasePage
{

    protected static ?string $title = 'Dashboard';

    protected int | string | array $columnSpan = [
        'md' => 1,
        'lg' => 1,
        'xl' => 1,
    ];

    protected function getHeader(): View
    {
        return view('filament.pages.dashboard.header');
    }
}