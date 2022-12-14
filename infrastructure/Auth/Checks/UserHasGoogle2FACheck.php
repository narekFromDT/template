<?php

namespace Infrastructure\Auth\Checks;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractCheck;
use Infrastructure\Eloquent\Models\UserPhone;

final class UserHasGoogle2FACheck extends AbstractCheck
{
    public function __construct(private readonly UserPhone $user)
    {
        //
    }

    public function execute(): Response
    {
        return new Response(!is_null($this->user->google_2fa_secret));
    }
}
