<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Patient;
use App\Models\Appointment;

class StatsOverview extends ChartWidget
{
    protected static ?string $heading = 'Patient & Appointment Trends';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $clinic = filament()->getTenant();

        // Generate labels for last 7 days
        $labels = collect(range(6, 0))
            ->map(fn ($daysAgo) => now()->subDays($daysAgo)->format('M d'))
            ->toArray();

        // Get patient counts per day
        $patientsPerDay = collect(range(6, 0))
            ->map(fn ($daysAgo) => Patient::where('clinic_id', $clinic->id)
                ->whereDate('created_at', now()->subDays($daysAgo))
                ->count())
            ->toArray();

        // Get appointment counts per day
        $appointmentsPerDay = collect(range(6, 0))
            ->map(fn ($daysAgo) => Appointment::where('clinic_id', $clinic->id)
                ->whereDate('created_at', now()->subDays($daysAgo))
                ->count())
            ->toArray();

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Patients Registered',
                    'data' => $patientsPerDay,
                    'borderColor' => '#3b82f6', // Blue
                    'backgroundColor' => 'rgba(59, 130, 246, 0.3)',
                    'fill' => true,
                ],
                [
                    'label' => 'Appointments Made',
                    'data' => $appointmentsPerDay,
                    'borderColor' => '#10b981', // Green
                    'backgroundColor' => 'rgba(16, 185, 129, 0.3)',
                    'fill' => true,
                ],
            ],
        ];
    }
}
