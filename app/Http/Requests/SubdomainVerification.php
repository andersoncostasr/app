<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubdomainVerification extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function atributes()
    {
        return [
            'subdomain' => 'Subdomínio',
        ];
    }

    public function rules()
    {
        return [
            'subdomain' => [
                'required',
                'min:5',
                'max:20'
            ],
        ];
    }
}
