<?php

namespace App\Filament\Resources\Pembelians;

use App\Filament\Resources\Pembelians\Pages\CreatePembelian;
use App\Filament\Resources\Pembelians\Pages\EditPembelian;
use App\Filament\Resources\Pembelians\Pages\ListPembelians;
use App\Filament\Resources\Pembelians\Schemas\PembelianForm;
use App\Filament\Resources\Pembelians\Tables\PembeliansTable;
use App\Models\Pembelian;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PembelianResource extends Resource
{
    protected static ?string $model = Pembelian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'pembelian';

    public static function form(Schema $schema): Schema
    {
        return PembelianForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PembeliansTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = Auth::user();

        
        if ($user->role === 'Guest') {
            $query->where('user_id', $user->id); // asumsikan ada kolom user_id
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPembelians::route('/'),
            'create' => CreatePembelian::route('/create'),
            'edit' => EditPembelian::route('/{record}/edit'),
        ];
    }
}