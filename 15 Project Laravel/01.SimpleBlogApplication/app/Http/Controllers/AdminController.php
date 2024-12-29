<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function index() {

        if (Auth::id()) {
            $usertype = Auth()->user()->usertype;
        }

        if ($usertype == 'user') {
            return view('dashboard');
        } else if ($usertype == 'admin') {
            return view('admin.index');
        } else {
            return redirect()->back();
        }

    }
}
