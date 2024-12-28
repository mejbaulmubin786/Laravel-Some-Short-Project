<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Pomodoro Timer</h1>
        <div class="timer">
            <span id="time-display">{{ $setting->work_time ?? 25 }}:00</span>
        </div>
        <div class="controls">
            <button id="start">Start</button>
            <button id="pause">Pause</button>
            <button id="reset">Reset</button>
        </div>
        <div class="settings">
            <h2>Settings</h2>
            <form action="{{ route('pomodoro.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="work_time">Work Time (minutes):</label>
                <input type="number" id="work_time" name="work_time" value="{{ $setting->work_time ?? 25 }}" required>

                <label for="break_time">Break Time (minutes):</label>
                <input type="number" id="break_time" name="break_time" value="{{ $setting->break_time ?? 5 }}" required>

                <label for="focus_sound">Focus Time Sound:</label>
                <input type="file" id="focus_sound" name="focus_sound" accept="audio/*">

                <label for="break_sound">Break Time Sound:</label>
                <input type="file" id="break_sound" name="break_sound" accept="audio/*">

                <button type="submit" id="apply-settings">Save Settings</button>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
