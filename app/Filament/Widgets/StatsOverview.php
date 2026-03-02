<?php

namespace App\Filament\Widgets;

use App\Models\Pembelian;
use App\Models\Produk;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    // Auto-refresh every 15 seconds
    protected ?string $pollingInterval = '15s';

    public static function canView(): bool
    {
        // Only visible to users with role 'Admin'
        return auth()->check() && auth()->user()->role === 'Admin';
    }

    protected function getStats(): array
    {
        // Calculate Total Revenue (only from 'Selesai' or 'Sampai' status? Let's assume 'Selesai' means completed payment)
        // Checking schema again, status can be 'Verifikasi', 'Proses', 'Kirim', 'Sampai', 'Selesai'
        // Assuming 'Selesai' is the final successful state for revenue.
        $totalRevenue = Pembelian::where('status', 'Selesai')->sum('bayar');
        
        // Total Orders
        $totalOrders = Pembelian::count();

        // Total Products
        $totalProducts = Produk::count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pendapatan dari pesanan selesai')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Dummy chart data for visual appeal

            Stat::make('Total Pesanan', $totalOrders)
                ->description('Semua pesanan masuk')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),

            Stat::make('Total Produk', $totalProducts)
                ->description('Jumlah produk terdaftar')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
        ];
    }
}
