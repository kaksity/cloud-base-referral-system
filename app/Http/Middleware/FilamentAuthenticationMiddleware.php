<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Models\Contracts\FilamentUser;

class FilamentAuthenticationMiddleware extends Authenticate
{
    protected function authenticate($request, array $guards): void
    {

        $guard = Filament::auth();


        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
            /** @phpstan-ignore-line */
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        /** @var Model $user */
        $user = $guard->user();

        $panel = Filament::getCurrentOrDefaultPanel();

        abort_if(
            $user instanceof FilamentUser ?
                (! $user->canAccessPanel($panel)) : (config('app.env') !== 'local'),
            403,
        );
    }

    protected function redirectTo($request): ?string
    {
        if (str_contains($request->url(), 'organization-admin')) {
            return Filament::getPanel('organization-admin')->getLoginUrl();
        };

        if (str_contains($request->url(), 'system-admin')) {
            return Filament::getPanel('system-admin')->getLoginUrl();
        };

        return Filament::getLoginUrl();
    }
}
