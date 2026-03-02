<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    Filament::serving(function () {
        Filament::registerNavigationItems([
            NavigationItem::make('Halaman Utama')
                ->url(route('homeproduk'))
                ->icon('heroicon-o-link')
                ->sort(100),
        ]);
    });

    Filament::registerRenderHook(
        PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
        fn () => new HtmlString(
            '<div class="mt-6 text-center">
                <a href="/" class="text-sm text-gray-400 hover:text-primary-500 transition">
                    ← Kembali ke Home
                </a>
            </div>'
        )
    );
}
}