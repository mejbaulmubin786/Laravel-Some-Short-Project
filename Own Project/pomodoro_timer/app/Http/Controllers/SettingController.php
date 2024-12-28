<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller {
    public function index() {
        // Fetch existing settings or default values
        $setting = Setting::first() ?? new Setting([
            'work_time' => 25,
            'break_time' => 5,
            'focus_sound' => null,
            'break_sound' => null,
        ]);

        return view('settings.index', compact('setting'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'work_time' => 'required|integer|min:1|max:60',
            'break_time' => 'required|integer|min:1|max:15',
            'focus_sound' => 'nullable|file|mimes:mp3,wav',
            'break_sound' => 'nullable|file|mimes:mp3,wav',
        ]);

        $setting = Setting::first() ?? new Setting();

        // Save focus sound
        if ($request->hasFile('focus_sound')) {
            $focusSoundPath = $request->file('focus_sound')->store('sounds', 'public');
            $validated['focus_sound'] = '/storage/' . $focusSoundPath;
        }

        // Save break sound
        if ($request->hasFile('break_sound')) {
            $breakSoundPath = $request->file('break_sound')->store('sounds', 'public');
            $validated['break_sound'] = '/storage/' . $breakSoundPath;
        }

        $setting->fill($validated);
        $setting->save();

        return redirect()->route('settings.index')->with('success', 'Settings saved successfully!');
    }
}
