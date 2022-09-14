<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company = Company::first();

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.company.index');
        }

        return view('company.index', compact('company'));
    }
}
