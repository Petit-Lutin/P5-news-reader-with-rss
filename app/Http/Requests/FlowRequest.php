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
            'url' => 'required|string|min:10', //todo:faire regex !  [http]+s\:\/\/[a-zA-Z0-9\-]{5,}
        ];
        if ($this->input('category_id') === '-1') {
            $rules['category_name'] = 'bail|required|between:2,50';
        }

        return $rules;
    }
}
