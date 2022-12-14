<?php

namespace Infrastructure\Eloquent;

use Illuminate\Support\Str;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\UserCountry;
use Infrastructure\Eloquent\Models\UserPhone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

final class ServiceProvider extends BaseServiceProvider
{
    public const MORPH_MAP = [
        'user' => User::class,
        'user-phone' => UserPhone::class,
        'user-country' => UserCountry::class,
    ];

    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(static fn ($name) => 'Database\\Factories\\' . class_basename($name) . 'Factory');
        Factory::guessModelNamesUsing(static fn ($name) => 'Infrastructure\\Eloquent\\Models\\' . Str::of(class_basename($name))->beforeLast('Factory'));

        Relation::enforceMorphMap(self::MORPH_MAP);
    }
}
