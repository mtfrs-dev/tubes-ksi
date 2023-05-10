<?php

namespace App\Http\Requests\Category;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    protected $errorBag = 'update_category';

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
                Rule::unique('categories')->ignore($this->input('id'), 'id')
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name'  =>  'Nama Kategori Obat',
            'code'  =>  'Kode Kategori Obat',
        ];
    }
}
