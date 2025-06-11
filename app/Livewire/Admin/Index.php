<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public string $quotationFilter = 'today';

    #[Computed]
    public function dateRange(): array
    {
        $now = Carbon::now();

        return match ($this->quotationFilter) {
            'today' => ['start' => $now->copy()->startOfDay(), 'end' => $now->copy()->endOfDay()],
            'last_7_days' => ['start' => $now->copy()->subDays(6)->startOfDay(), 'end' => $now->copy()->endOfDay(),],
            'this_month' => ['start' => $now->copy()->startOfMonth(), 'end' => $now->copy()->endOfMonth()],
            'last_month' => ['start' => $now->copy()->subMonth()->startOfMonth(), 'end' => $now->copy()->subMonth()->endOfMonth()],
            'this_year' => ['start' => $now->copy()->startOfYear(), 'end' => $now->copy()->endOfYear()],
            'last_year' => ['start' => $now->copy()->subYear()->startOfYear(), 'end' => $now->copy()->subYear()->endOfYear()],
            default => ['start' => $now->copy()->startOfMonth(), 'end' => $now->copy()->endOfMonth()],
        };
    }

    protected function appointmentCountByStatus(string $status, bool $useDate = true): int
    {
        return Appointment::whereHas(
            'latestStatus',
            fn($query) =>
            $query->whereHas('status', fn($q) => $q->where('name', $status))
        )
            ->when(
                $useDate,
                fn($query) =>
                $query->whereBetween('assembly_date', [$this->dateRange['start'], $this->dateRange['end']])
            )
            ->count();
    }

    protected function orderCountByStatus(string $status): int
    {
        return Order::whereHas(
            'latestStatus',
            fn($query) =>
            $query->whereBetween('created_at', [$this->dateRange['start'], $this->dateRange['end']])
                ->whereHas('status', fn($q) => $q->where('name', $status))
        )->count();
    }

    #[Computed]
    public function validated(): int
    {
        return $this->appointmentCountByStatus('Validated');
    }

    #[Computed]
    public function pending(): int
    {
        return $this->appointmentCountByStatus('Pending', false); // no date filter
    }

    #[Computed]
    public function ongoing(): int
    {
        return $this->appointmentCountByStatus('Ongoing');
    }

    #[Computed]
    public function pendingOrders(): int
    {
        return $this->orderCountByStatus('Pending');
    }

    #[Computed]
    public function quotationAppointment(): float
    {
        return round(Appointment::whereHas('latestStatus', function ($query) {
            $query->whereHas(
                'status',
                fn($q) =>
                $q->whereIn('name', ['Ongoing', 'Archived'])
            );
        })
            ->whereBetween('assembly_date', [$this->dateRange['start'], $this->dateRange['end']])
            ->sum('price'), 2);
    }

    #[Computed]
    public function quotationOrder(): float
    {
        $orders = Order::whereHas('latestStatus', function ($query) {
            $query->whereBetween('created_at', [$this->dateRange['start'], $this->dateRange['end']])
                ->whereHas(
                    'status',
                    fn($q) =>
                    $q->where('name', 'Delivered')
                );
        })->get();

        return round($orders->sum(fn($order) => $order->totalNoDelivery), 2);
    }

    #[Layout('components.layouts.admin.app')]
    public function render()
    {
        return view('livewire.admin.index');
    }
}
