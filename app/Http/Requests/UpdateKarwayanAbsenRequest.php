<?php

namespace App\Http\Requests;

use App\Models\KaryawanAbsen;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKarwayanAbsenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request('id');

        $rules = KaryawanAbsen::$rules;

        return $rules;
    }

    // custom message
    public function attributes()
    {
        return KaryawanAbsen::$ruleMessages;
    }
}
