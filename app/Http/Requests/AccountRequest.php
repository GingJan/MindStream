<?php

namespace MindStream\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends CommonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ('enabled' === end($this->segments())) {
            return \Auth::user()->can(['toggle-enabled']);
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ('password' === end($this->segments())) {
            return [
                'uuid' => ['required'],
                'password' => ['required', 'string'],
                'new_password' => ['required', 'string'],
            ];
        }
    }
}
