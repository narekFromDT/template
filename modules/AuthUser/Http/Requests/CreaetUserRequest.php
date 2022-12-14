<?php

namespace Modules\AuthUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\AuthUser\Dto\CreateUserDto;

final class CreaetUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email'       => [
                'unique:users,email',
                'required',
                'email',
                'max:50',
            ],
            'fullName'    => [
                'required',
                'string',
                'max:50',
            ],
            'country'     => [
                'required',
                'string',
                'max:50',
            ],
            'phoneNumber' => [
                'unique:user_phones,phone',
                'required',
                'string',
                'max:20',
            ],
        ];
    }

    public function toDto(): CreateUserDto
    {
        return new CreateUserDto(
            $this->input('email'),
            $this->input('fullName'),
            $this->input('country'),
            $this->input('phoneNumber'),
        );
    }
}
