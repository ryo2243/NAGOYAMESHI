<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $term = Term::first();

        return view('admin.terms.index', compact('term'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term) {
        return view('admin.terms.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Term $term) {
        $request->validate([
            'content' => 'required',
        ]);

        $term->content = $request->input('content');
        $term->save();

        return redirect()->route('admin.terms.index', $term)->with('flash_message', '利用規約を編集しました。');
    }
}
