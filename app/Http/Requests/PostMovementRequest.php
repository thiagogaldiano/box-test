<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

class PostMovementRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'movement_type_id' => 'required|exists:movement_types,id',
            'movement_id' => 'required_if:movement_type_id,==,3',
            'value' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Por favor, entre o usuário que fará a movimentação!',
            'movement_type_id.required' => 'Por favor, entre com o tipo da movimentação !',
            'value.required' => 'Por favor, entre com o valor da movimentação !',
            'movement_id.required_if' => 'Por favor, entre com a movimentação do estorno!'
        ];
    }
}
