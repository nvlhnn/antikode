<?php

namespace App\Http\Requests;

use App\Helpers\ResponseHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreOutletRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'picture' => 'required|image|mimes:jpg,png,jpeg,svg|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
            'brand_id' => 'required|exists:brands,id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json(ResponseHelper::response(false, $validator->errors()->first()), 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    
    }
}
