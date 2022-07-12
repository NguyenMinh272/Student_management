<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use function PHPUnit\Framework\throwException;

class StudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'full_name'=>'required|min:6|max:40',
            'address'=>'required|max:255',
            'email'=>'required|email:rfc,dns|unique:students,email,'.$this->id,
            'birthday'=>'required|date',
            'gender'=>'required',
            'phone'=>'required|max:12',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'faculty_id'=>'required'
        ];
    }

    public function failed(Validator $validator)
    {
        return $error = ['code'=> 422, 'message'=>$validator->errors()];
        throw new \HttpRequestException(response()->json($error, 422));
    }
}
