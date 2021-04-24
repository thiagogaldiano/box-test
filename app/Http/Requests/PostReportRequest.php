<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

class PostReportRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator) { 

        throw new HttpResponseException(
            response()->json([
                'messages' => $validator->errors()->all()
            ], 400)
        ); 
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'exists:users,id',
            'year' => 'required_if:filter,==,2',
            'month' => 'required_if:filter,==,2'
        ];
    }

    public function messages()
    {
        return [
            'user_id.exists' => 'Por favor, entre um usuário cadastrado!',
            'year.required_if' => 'Por favor, entre com o ano !',
            'month.required_if' => 'Por favor, entre com o mês !'
        ];
    }
}
