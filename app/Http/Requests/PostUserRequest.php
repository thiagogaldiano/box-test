<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

class PostUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email',
            'name' => 'required|max:150',
            'birthday' => 'required|date_format:Y-m-d|before:-18 years',       
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Por favor, entre com e-mail do usuário!',
            'name.required' => 'Por favor, entre com o nome do usuário !',
            'birthday.required' => 'Por favor, entre com a data de aniversário do usuário !',
            'birthday.before' => 'O usuário precisa ter 18 anos para efetuar o cadastro !',
            'birthday.date_format' => 'Entre com uma data válida!',
            'password.required' => 'Por favor, entre com a senha do usuário !'
        ];
    }
}
