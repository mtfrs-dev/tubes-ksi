<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Requests\Medicine\UpdateMedicineRequest;

class MedicineController extends Controller
{
    public function index()
    {
        // $category = "Sirup";
        // $medicines = Medicine::query()
        //     ->with([
        //         'unit',
        //         'categories'
        //     ])
        //     ->whereHas('categories', function($query) use ($category) {
        //         $query->where('name', 'like', '%' . $category . '%');
        //     })
        //     ->get();
        // $medicines = Medicine::query()
        //     ->with([
        //         'unit',
        //         'categories'
        //     ])
        //     // ->where('units.name', 'Miligram')
        //     ->get(););
        // dd($medicines);

        // return view('pages.medicines.index', compact('medicines'));
        $categories = Category::all();
        $units = Unit::all();
        return view('pages.medicines.index', compact('categories', 'units'));
    }

    public function update(UpdateMedicineRequest $request)
    {
        $validated = $request->validated();
        $medicine = Medicine::find($request->id);

        // Getting old categories data from category_medicine pivot table
        $old_categories = $medicine->categories->pluck('id')->toArray();
        // Getting new categories data from input
        $new_categories = $validated["categories"];
        
        // Getting old categories data that doesn't exist in new categories from input
        $delete_old = array_diff($old_categories, $new_categories);
        // Getting new categories data that doesn't exist in old categories from pivot
        $save_new   = array_diff($new_categories, $old_categories);
        
        // Deleting old categories that doesn't exist in new categories from input
        foreach ($delete_old as $key => $value) {
            $medicine->categories()->wherePivot('category_id', $value)->detach();
        }

        // Storing new categories that doesn't exist in old categories from pivot
        foreach ($save_new as $key => $value) {
            $medicine->categories()->attach($value);
        }

        $medicine->name         = $validated["name"];
        $medicine->code         = $validated["code"];
        $medicine->qr_code      = $validated["qr_code"];
        $medicine->buy_price    = $validated["buy_price"];
        $medicine->sell_price   = $validated["sell_price"];
        $medicine->quantity     = $validated["quantity"];
        $medicine->unit_id         = $validated["unit_id"];

        $medicine->save();

        return redirect()->back()
            ->with("success","Perubahan pada data obat berhasil disimpan!");
    }
}
