<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/**
 * @property-read string $code
 * @property-read string $referer
 * @property-read string $client_id
  */
class CredentialsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'string|required',
            'referer' => 'string|required',
            'client_id' => 'string|required'
        ];
    }
}
