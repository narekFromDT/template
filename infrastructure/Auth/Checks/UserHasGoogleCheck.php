<?php

namespace Infrastructure\Auth\Checks;

use Illuminate\Auth\Access\Response;
use Infrastructure\Auth\AbstractCheck;
use Infrastructure\Eloquent\Models\UserPhone;

final class UserHasGoogleCheck extends AbstractCheck
{
    public function __construct(private readonly UserPhone $user)
    {
        //
    }

    public function execute(): Response
    {
        return new Response(!is_null($this->user->google_id));
    }
}
