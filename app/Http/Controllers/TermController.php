<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $term = Term::first();

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.terms.index');
        }

        return view('terms.index', compact('term'));
    }
}
