<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;

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

    public function update(Request $request)
    {
        dd($request);
    }
}
