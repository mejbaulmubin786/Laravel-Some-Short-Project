<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Settings</title>
</head>
<body>
    <h1>Pomodoro Timer Settings</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="work_time">Work Time (minutes):</label>
            <input type="number" name="work_time" id="work_time" value="{{ old('work_time', $setting->work_time) }}">
        </div>
        <div>
            <label for="break_time">Break Time (minutes):</label>
            <input type="number" name="break_time" id="break_time" value="{{ old('break_time', $setting->break_time) }}">
        </div>
        <div>
            <label for="focus_sound">Focus Sound:</label>
            <input type="file" name="focus_sound" id="focus_sound">
        </div>
        <div>
            <label for="break_sound">Break Sound:</label>
            <input type="file" name="break_sound" id="break_sound">
        </div>
        <button type="submit">Save Settings</button>
    </form>
</body>
</html>
