<?php

namespace App\Http\Requests\Unit;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
{
    protected $errorBag = 'store_unit';

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
                Rule::unique('units')
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
