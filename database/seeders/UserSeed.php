<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Infrastructure\Eloquent\Models\UserPhone;

final class UserSeed extends Seeder
{
    public function run(): void
    {
        DB::transaction(static function (): void {
            UserPhone::create([
                'email' => env('ADMIN_INITIAL_EMAIL'),
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD')),
                'registered_at' => Carbon::now(),
                'email_verification_token' => true,
            ]);
        });
    }
}
