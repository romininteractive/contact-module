<?php

namespace Modules\Contact\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateContactRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'salutation'   => 'required',
            'first_name'   => 'required',
            'last_name'    => 'required',
            'company_name' => 'min:3',
            'email'        => 'nullable|email',
            'phone'        => 'nullable|numeric|digits:10',
            'gstin'        => 'nullable|regex:/^([0-9]){2}([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}([0-9]){1}([a-zA-Z1-9]){1}([a-zA-Z0-9]){1}$/',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}
