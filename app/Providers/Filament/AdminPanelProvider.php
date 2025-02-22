<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Notifications\Notification;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Monzer\FilamentEmailVerificationAlert\EmailVerificationAlertPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin') //  ini buat nama path nya di url 
            ->login()
            ->registration() //ini untu kmembuat sign-up
            ->passwordReset() // untuk panel reset password 
            ->emailVerification() //ini buat fungsi forgot password
            ->profile()
            ->colors([
                'primary' => Color::Rose,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])

            // warna-warna tambahan

            ->colors([
                'danger' => Color::Rose,
                'gray' => Color::Gray,
                'info' => Color::Yellow,
                'primary' => Color::Blue,
                'success' => Color::Green,
                'warning' => Color::Orange,
                // Warna tambahan
                'slate' => Color::Slate,
                'zinc' => Color::Zinc,
                'neutral' => Color::Neutral,
                'stone' => Color::Stone,
                'red' => Color::Red,
                'orange' => Color::Orange,
                'yellow' => Color::Yellow,
                'green' => Color::Green,
                'blue' => Color::Blue,
                'amber' => Color::Amber,
                'lime' => Color::Lime,
                'emerald' => Color::Emerald,
                'teal' => Color::Teal,
                'cyan' => Color::Cyan,
                'sky' => Color::Sky,
                'indigo' => Color::Indigo,
                'violet' => Color::Violet,
                'purple' => Color::Purple,
                'fuchsia' => Color::Fuchsia,
                'pink' => Color::Pink,
                'rose' => Color::Rose,
            ])

            ->plugins([
                EmailVerificationAlertPlugin::make()
                    ->color('red')
                    ->persistClosedState()
                    ->closable(true)
                    ->placeholder(true)
                    ->renderHookName('panels::page.start')
                    // ->renderHookScopes([ListUsers::class])
                    ->lazy(false)
                    ->closable(false)
                    ->verifyUsing(function($user) {
                     // Custom verification logic
                    //   $user->notify(new CostomVerificationNontification()); /class yang isinya bakal kirim nontifikasi secara custom
     
                    Notification::make()
                    ->title(trans('filament-email-verification-alert::messages.verification.success'))
                    ->success()
                    ->send();
                    }),
            ]);
    }
}
