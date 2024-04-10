<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all(); // companiesテーブルからすべてのデータを取得
        return view('company', ['companies' => $companies]); // companiesをビューに渡す
    }
}
