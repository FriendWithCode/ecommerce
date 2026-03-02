<?php

namespace App\Filament\Resources\Pembelians\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PembelianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_pembelian')
                    ->required()
                    ->unique(ignorable: fn($record) => $record)
                    ->disabled(), 

                Select::make('produk_id')
                    ->relationship('produk', 'nama')
                    ->required()
                    ->disabled(), 

                TextInput::make('banyak')
                    ->required()
                    ->numeric()
                    ->disabled(), 

                TextInput::make('bayar')
                    ->required()
                    ->numeric()
                    ->disabled(), 

                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->disabled(), 

                Select::make('status')
                    ->options([
                        'Verifikasi' => 'Verifikasi',
                        'Proses' => 'Proses',
                        'Kirim' => 'Kirim',
                        'Sampai' => 'Sampai',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(), 
            ]);
    }
}