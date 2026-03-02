<?php

namespace App\Filament\Widgets;

use App\Models\Pembelian;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class CustomerOverview extends BaseWidget
{
    // Auto-refresh every 15 seconds
    protected ?string $pollingInterval = '15s';

    public static function canView(): bool
    {
        // Visible to logged in users who are NOT Admin
        return auth()->check() && auth()->user()->role !== 'Admin';
    }

    protected function getStats(): array
    {
        $user = Auth::user();
        
        // Personal stats
        $myOrders = Pembelian::where('user_id', $user->id)->count();
        $pendingOrders = Pembelian::where('user_id', $user->id)
            ->whereNotIn('status', ['Selesai', 'Sampai']) // Assuming these are completed states
            ->count();
        $totalSpent = Pembelian::where('user_id', $user->id)
            ->where('status', 'Selesai')
            ->sum('bayar');

        return [
            Stat::make('Pesanan Saya', $myOrders)
                ->description('Total riwayat pesanan')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),

            Stat::make('Dalam Proses', $pendingOrders)
                ->description('Pesanan belum selesai')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Total Belanja', 'Rp ' . number_format($totalSpent, 0, ',', '.'))
                ->description('Total pengeluaran selesai')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
