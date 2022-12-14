<?php

namespace Modules\AuthUser\Http\Actions;

use Illuminate\Http\JsonResponse;
use Infrastructure\Eloquent\Models\User;
use Modules\AuthUser\Exceptions\CreateUserFailedException;
use Modules\AuthUser\Http\Requests\CreaetUserRequest;
use Modules\AuthUser\Services\UserCommandService;

final class CreateUserAction
{
    /**
     * @OA\Post(
     *      path="/authUser",
     *      tags={"AuthUser"},
     *      description=" email using verification token",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="fullName", type="string"),
     *              @OA\Property(property="country", type="string"),
     *              @OA\Property(property="phoneNumber", type="int"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/MessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Failed email verification",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Too many attempts",
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/ErrorMessageSchema",
     *          ),
     *      ),
     * )
     */
    public function __invoke(CreaetUserRequest $request, UserCommandService $service): JsonResponse
    {
        try {
            $userId = $service->create($request->toDto());

            return response()->id($userId, JsonResponse::HTTP_CREATED);
        } catch (CreateUserFailedException) {
            return response()->errorMessage(trans('messages.user.user_registration_failed'));
        }
    }
}
