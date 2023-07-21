<?php

namespace App\Http\Requests\Courses;

use App\Rules\TenantUnique;
use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
            'name' => [
                'required',
                'min:5',
                'max:100',
            ],
            'module_id' => [
                'required'
            ],
            'video' => [
                'required',
                'max:50'
            ]
        ];
    }
}
