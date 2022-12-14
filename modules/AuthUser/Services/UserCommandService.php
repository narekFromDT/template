<?php

namespace Modules\AuthUser\Services;

use Illuminate\Support\Facades\DB;
use Infrastructure\Eloquent\Models\User;
use Infrastructure\Eloquent\Models\UserCountry;
use Infrastructure\Eloquent\Models\UserPhone;
use Modules\AuthUser\Dto\CreateUserDto;
use Modules\AuthUser\Jobs\CreateUserMailJob;
use Modules\AuthUser\Jobs\CreateUserSMSJob;

final class UserCommandService
{
    public function create(CreateUserDto $request): int
    {
        return DB::transaction(static function () use ($request): int {
            $user = User::create([
                'email'     => $request->email,
                'full_name' => $request->fullName,
            ]);

            UserCountry::create([
                'name'    => $request->country,
                'user_id' => $user->id,
            ]);

            $userPhone = UserPhone::create([
                'phone'   => $request->phoneNumber,
                'user_id' => $user->id,
            ]);

            dispatch(new CreateUserMailJob([
                'user' => $user,
            ]));

            dispatch(new CreateUserSMSJob([
                'user'        => $user,
                'userPhone'   => $userPhone,
            ]));

            return $user->id;
        });
    }
}
