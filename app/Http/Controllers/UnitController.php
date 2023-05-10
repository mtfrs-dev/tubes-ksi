<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Unit\StoreUnitRequest;
use App\Http\Requests\Unit\UpdateUnitRequest;

class UnitController extends Controller
{
    public function index()
    {
        return view('pages.units.index');
    }

    public function store(StoreUnitRequest $request)
    {
        $validated = $request->validated();

        $unit = Unit::create([
            'name'  =>  $validated['name'],
            'code'  =>  $validated['code']
        ]);

        return redirect()->back()
            ->with("success","Data satuan obat berhasil disimpan!");
    }
    
    public function update(UpdateUnitRequest $request)
    {
        $validated = $request->validated();
        $unit = Unit::find($request->id);

        $unit->name = $validated['name'];
        $unit->code = $validated['code'];

        $unit->save();

        return redirect()->back()
            ->with("success","Perubahan pada data satuan obat berhasil disimpan!");
    }
}
