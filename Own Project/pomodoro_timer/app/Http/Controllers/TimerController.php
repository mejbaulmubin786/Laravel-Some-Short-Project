<?php

namespace App\Http\Controllers;

use App\Models\Setting;

class TimerController extends Controller {
    public function index() {
        // Fetch saved settings or default values
        $setting = Setting::first() ?? new Setting([
            'work_time' => 25,
            'break_time' => 5,
            'focus_sound' => null,
            'break_sound' => null,
        ]);

        return view('timer.index', compact('setting'));
    }
}
