<?php

namespace App\Http\Controllers;

class PomodoroController extends Controller {
    public function index() {
        // প্রয়োজনীয় ডেটা ভিউতে পাঠান
        return view('pomodoro');
    }
}
