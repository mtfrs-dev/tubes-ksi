<?php

namespace App\Http\Requests\Medicine;

use App\Models\Medicine;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    protected $errorBag = 'update_medicine';

    public function authorize(): bool
    {
        return auth()->check();
    }
    
    public function rules(): array
    {
        return [
            'name'          =>  'required|string|max:255',
            'code'          =>  [
                'required',
                Rule::unique('medicines')->ignore($this->input('id'), 'id')
            ],
            'qr_code'       =>  [
                'required',
                Rule::unique('medicines')->ignore($this->input('id'), 'id')
            ],
            'categories'    =>  'required|array',
            'buy_price'     =>  'required',
            'sell_price'    =>  'required',
            'quantity'      =>  'required',
            'unit_id'          =>  'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'          =>  'Nama Obat',
            'code'          =>  'Kode Obat',
            'qr_code'       =>  'Barcode Obat',
            'categories'    =>  'Kategori Obat',
            'buy_price'     =>  'Harga Beli Obat',
            'sell_price'    =>  'Harga Jual Obat',
            'quantity'      =>  'Kuantitas Obat',
            'unit_id'          =>  'Satuan Obat'
        ];
    }
}
