<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResidentialUnitsRequest extends FormRequest {
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:100'],
            'address' => ['string', 'max:200', 'nullable'],
            'year_built' => ['string', 'max:10', 'nullable'],
            'stratum_id' => ['numeric', 'nullable', Rule::exists('master_options','id')],
            'status' => ['required','numeric'],
            'specifications' => ['array']
        ];
    }
}
