<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Booking;
use Filament\Widgets\LineChartWidget;

class BookingsChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    public $active_filter = 'last_7_days';

    protected $listeners = ['updateFilter'];

    protected function getHeading(): string
    {
        return 'Bookings';
    }

    public function updateFilter($state)
    {
        $this->active_filter = $state;
    }

    protected function getData(): array
    {
        $filter = $this->active_filter; // e.g. last 7 days

        $data['data'] = [];
        $data['label'] = [];

        switch ($filter) {
            case 'last_7_days':
                $data = $this->last7Days();
                break;
            case 'last_30_days':
                $data = $this->last30Days();
                break;
            case 'last_90_days':
                $data = $this->last90Days();
                break;
            case 'last_6_months':
                $data = $this->last6Months();
                break;
            case 'this_year':
                $data = $this->thisYear();
                break;
            case 'last_year':
                $data = $this->lastYear();
                break;
            default:
                $data = $this->last7Days();
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Booking',
                    'data' => $data['data'],
                ],
            ],
            'labels' => $data['label'],
        ];
    }

    public function last7Days()
    {
        $start = Carbon::today()->subDays(7);
        $end = now();
        $days = [];
        $data = [];

        foreach ($start->daysUntil($end) as $date) {
            $var_date = $date->format('Y-m-d');

            $bookings = Booking::whereDate('created_at', $var_date)->count();
            $data[] = $bookings;
            $days[] = $date->format('M d');
        }
        
        return [
            'data' => $data,
            'label' => $days
        ];
    }

    public function last30Days()
    {
        $start = Carbon::today()->subDays(30);
        $end = now();
        $days = [];
        $data = [];

        foreach ($start->daysUntil($end) as $date) {
            $var_date = $date->format('Y-m-d');

            $bookings = Booking::whereDate('created_at', $var_date)->count();
            $data[] = $bookings;
            $days[] = $date->format('M d');
        }
        
        return [
            'data' => $data,
            'label' => $days
        ];
    }

    public function last90Days()
    {
        $start = Carbon::today()->subDays(30);
        $end = now();
        $days = [];
        $data = [];

        foreach ($start->daysUntil($end) as $date) {
            $var_date = $date->format('Y-m-d');

            $bookings = Booking::whereDate('created_at', $var_date)->count();
            $data[] = $bookings;
            $days[] = $date->format('M d');
        }
        
        return [
            'data' => $data,
            'label' => $days
        ];
    }

    public function last6Months()
    {
        $start = Carbon::today()->subMonths(5)->startOfMonth();
        $months = array();
        $data = [];

        // Loop through the months
        for ($i = 0; $i < 6; $i++) {
            $month = $start->copy()->addMonthsNoOverflow($i);

            $var_month = $month->format('m');

            $bookings = Booking::whereMonth('created_at', $var_month)->count();
            $data[] = $bookings;
            $months[] = $month->format('M Y');
        }
        
        return [
            'data' => $data,
            'label' => $months
        ];
    }

    public function thisYear()
    {   
        $data = [];
        $months = array();

        $start = Carbon::now()->startOfYear();
        $current_month = Carbon::now()->month;

        
        for ($i = 1; $i <= $current_month; $i++) {
            $month = $start->copy()->addMonthsNoOverflow($i-1);
            $var_month = $month->format('m');

            $bookings = Booking::whereMonth('created_at', $var_month)->count();
            $data[] = $bookings;
            $months[] = $month->format('M Y');
        }
        
        return [
            'data' => $data,
            'label' => $months
        ];
    }

    public function lastYear()
    {   
        $data = [];
        $months = array();

        $start = Carbon::now()->subYear()->startOfYear();
        $current_month = Carbon::now()->month;

        
        for ($i = 1; $i <= 12; $i++) {
            $month = $start->copy()->addMonthsNoOverflow($i-1);
            $var_month = $month->format('m');

            $bookings = Booking::whereMonth('created_at', $var_month)->count();
            $data[] = $bookings;
            $months[] = $month->format('M Y');
        }
        
        return [
            'data' => $data,
            'label' => $months
        ];
    }
}
