<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SaveUpdateRequest extends Request
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
//            'update_summary' => 'required',
        ];
        return $rules;

    }
}
