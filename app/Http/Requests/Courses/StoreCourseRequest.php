<?php

namespace App\Http\Requests\Courses;

use App\Rules\TenantUnique;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
                'unique:courses',
                'min:3',
                'max:100',
                new TenantUnique('courses', $this->segment(2)),
            ],
            'description' => [
                'required',
                'min:3',
                'max:1000'
            ]
        ];
    }
}
