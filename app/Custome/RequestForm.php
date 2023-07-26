<?php

namespace App\Custome;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RequestForm extends FormRequest
{
    public $stopOnFirstFailure = true;

    protected function failedValidation(Validator $validator): void {
        $response = new JsonResponse([
            'message' => [$validator->errors()->first()],
        ], 400);

        throw new HttpResponseException($response);
    }
}
