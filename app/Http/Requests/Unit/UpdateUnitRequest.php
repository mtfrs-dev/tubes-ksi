<?php

namespace App\Http\Requests\Unit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUnitRequest extends FormRequest
{
    protected $errorBag = 'update_unit';

    public function authorize(): bool
    {
        return auth()->check();
    }
    
    public function rules(): array
    {
        return [
            'name'  =>  'required|string|max:255',
            'code'  =>  [
                'required',
                Rule::unique('units')->ignore($this->input('id'), 'id')
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name'  =>  'Nama Satuan Obat',
            'code'  =>  'Kode Satuan Obat',
        ];
    }
}
