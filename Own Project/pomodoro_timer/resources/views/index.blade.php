<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
    <script>
        let timerInterval;
        let isRunning = false;
        let isBreak = false;
        let workTime = {{ $setting->work_time * 60 }}; // Work time in seconds
        let breakTime = {{ $setting->break_time * 60 }}; // Break time in seconds
        let timeLeft = workTime;

        let focusSound = "{{ $setting->focus_sound }}";
        let breakSound = "{{ $setting->break_sound }}";

        function updateDisplay() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            document.getElementById('time-display').textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        function startTimer() {
            if (!isRunning) {
                isRunning = true;
                timerInterval = setInterval(() => {
                    if (timeLeft > 0) {
                        timeLeft--;
                        updateDisplay();
                    } else {
                        clearInterval(timerInterval);
                        isRunning = false;
                        isBreak = !isBreak;

                        if (isBreak) {
                            playSound(breakSound);
                            timeLeft = breakTime;
                            document.getElementById('status').textContent = "Time for a Break!";
                        } else {
                            playSound(focusSound);
                            timeLeft = workTime;
                            document.getElementById('status').textContent = "Time to Focus!";
                        }
                        startTimer();
                    }
                }, 1000);
            }
        }

        function pauseTimer() {
            clearInterval(timerInterval);
            isRunning = false;
        }

        function resetTimer() {
            clearInterval(timerInterval);
            isRunning = false;
            isBreak = false;
            timeLeft = workTime;
            updateDisplay();
            document.getElementById('status').textContent = "Time to Focus!";
        }

        function playSound(soundPath) {
            if (soundPath) {
                const audio = new Audio(soundPath);
                audio.play();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            updateDisplay();
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f9;
            padding: 20px;
        }
        #timer-container {
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
        }
        #time-display {
            font-size: 48px;
            font-weight: bold;
            margin: 20px 0;
        }
        #status {
            font-size: 24px;
            margin-bottom: 20px;
        }
        button {
            padding: 10px 15px;
            margin: 5px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #start {
            background-color: #28a745;
            color: white;
        }
        #pause {
            background-color: #ffc107;
            color: black;
        }
        #reset {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
    <div id="timer-container">
        <h1>Pomodoro Timer</h1>
        <div id="time-display">00:00</div>
        <div id="status">Time to Focus!</div>
        <button id="start" onclick="startTimer()">Start</button>
        <button id="pause" onclick="pauseTimer()">Pause</button>
        <button id="reset" onclick="resetTimer()">Reset</button>
    </div>
</body>
</html>
