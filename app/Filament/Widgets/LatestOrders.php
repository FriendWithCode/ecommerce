<?php

namespace App\Filament\Widgets;

use App\Models\Pembelian;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    // Auto-refresh every 15 seconds
    protected ?string $pollingInterval = '15s';

    public static function canView(): bool
    {
        // Only visible to users with role 'Admin'
        return auth()->check() && auth()->user()->role === 'Admin';
    }
    
    // Set widget width to full width if preferred, or default half/half
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Get latest 5 orders
                Pembelian::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('kode_pembelian')
                    ->label('Kode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name') // Assuming User model has 'name'
                    ->label('Pembeli'),
                Tables\Columns\ImageColumn::make('produk.image')
                    ->label('Foto')
                    ->getStateUsing(fn($record) => asset('storage/' . $record->produk?->image))
                    ->circular(),
                Tables\Columns\TextColumn::make('produk.nama') // Assuming Pembelian belongsTo Produk
                    ->label('Produk'),
                Tables\Columns\TextColumn::make('bayar')
                    ->label('Total Bayar')
                    ->money('IDR'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'Verifikasi',
                        'info' => 'Proses',
                        'primary' => 'Kirim',
                        'success' => 'Sampai', 
                        'success' => 'Selesai',
                    ]),
               
            ])
            ->paginated(false); // Hide pagination since we only show latest 5
    }
}
