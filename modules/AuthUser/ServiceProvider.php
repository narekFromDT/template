<?php

namespace Modules\AuthUser;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Modules\AuthUser\Policies\CreateUserPolicy;
use Infrastructure\Auth\DefineGates;

final class ServiceProvider extends BaseServiceProvider
{
    use DefineGates;

    protected array $gates = [
        'auth:email' => CreateUserPolicy::class,
    ];

    public function boot(): void
    {
        $this->defineGates();
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    }
}
