<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlowRequest extends FormRequest
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
        $rules = [

//            'title' => ['required', 'between:2,50'],
            'name' => 'bail|required|between:2,50',
            'category_id' => 'required|numeric',
            'url' => [
                'required',
                'min:10',
                'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,})([\/\w\.-]*)*\/?$/'

            ]
        ];
        if ($this->input('category_id') === '-1') {
            $rules['category_name'] = 'bail|required|between:2,50';
        }

        return $rules;
    }
}

return [
    'password' => [
        'required',
        'confirmed',
        'min:8',
        'max:50',
        'regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
    ]
];
