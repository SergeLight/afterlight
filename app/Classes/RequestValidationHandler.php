<?php

namespace App\Classes;

use Illuminate\Contracts\Validation\Validator as ValidatorAlias;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait RequestValidationHandler
{

    private static array $VALIDATIONS = [
        'register' => [
            'username' => 'required|min:5|max:50|alpha_dash|unique:users',
            'email' => 'required|email:rfc,dns|min:5|max:50|unique:users',
            'password' => 'required|min:6|max:50',
            'password_confirm' => 'required_with:password|same:password|min:6|max:50'
        ],
        'login-email' => [
            'username_login' => 'required|email:rfc,dns|min:5|max:50|alpha_dash',
            'password_login' => 'required|min:6|max:50'
        ],
        'login-username' => [
            'username_login' => 'required|min:5|max:50|alpha_dash',
            'password_login' => 'required|min:6|max:50'
        ],
        'not_authorized' => ['not_authorized' => 'required|min:999'] //TODO make a weird big regex here
    ];

    /**
     * @param Request $request
     * @param $name
     * @return ValidatorAlias|\Illuminate\Validation\Validator
     */
    public function validateRequest(Request $request, $name): ValidatorAlias|\Illuminate\Validation\Validator
    {
        return Validator::make($request->all(), self::$VALIDATIONS[$name] ?? self::$VALIDATIONS['not_authorized']);
    }

    public function errorsReturn(ValidatorAlias $validator): JsonResponse
    {
        return response()->json([
            'error' => $validator->errors()
        ]);
    }
}
