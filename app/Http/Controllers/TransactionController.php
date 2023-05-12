<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $suppliers = User::where('role', 'SUPPLIER')->get();
        $customers = User::where('role', 'CUSTOMER')->get();
        $medicines = Medicine::all();
        $units     = Unit::all();


        return view('pages.transactions.index', compact('suppliers', 'customers', 'medicines', 'units'));
    }
}
