let timerInterval;
let isRunning = false;
let isBreak = false;
let workTime = 25 * 60; // Default work time in seconds
let breakTime = 5 * 60; // Default break time in seconds
let timeLeft = workTime;
let sessionCount = 0;

let focusSound;
let breakSound;

const timeDisplay = document.getElementById("time-display");
const statusText = document.getElementById("status-text");
const sessionCountDisplay = document.getElementById("session-count");
const startButton = document.getElementById("start");
const pauseButton = document.getElementById("pause");
const resetButton = document.getElementById("reset");
const applySettingsButton = document.getElementById("apply-settings");
const workTimeInput = document.getElementById("work-time");
const breakTimeInput = document.getElementById("break-time");
const focusSoundInput = document.getElementById("focus-sound");
const breakSoundInput = document.getElementById("break-sound");

// Load settings from the server
function loadSettings() {
    fetch("/settings")
        .then((response) => response.json())
        .then((data) => {
            workTime = data.work_time * 60;
            breakTime = data.break_time * 60;

            if (data.focus_sound) {
                focusSound = new Audio(data.focus_sound);
            }
            if (data.break_sound) {
                breakSound = new Audio(data.break_sound);
            }

            timeLeft = workTime;
            updateDisplay();
            workTimeInput.value = data.work_time;
            breakTimeInput.value = data.break_time;
        })
        .catch((error) => console.error("Error loading settings:", error));
}

// Save settings to the server
function saveSettings() {
    const formData = new FormData();
    formData.append("work_time", workTimeInput.value);
    formData.append("break_time", breakTimeInput.value);

    if (focusSoundInput.files[0]) {
        formData.append("focus_sound", focusSoundInput.files[0]);
    }
    if (breakSoundInput.files[0]) {
        formData.append("break_sound", breakSoundInput.files[0]);
    }

    fetch("/settings", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            alert("Settings saved successfully!");
            loadSettings(); // Reload settings to reflect changes
        })
        .catch((error) => console.error("Error saving settings:", error));
}

// Start the timer
startButton.addEventListener("click", () => {
    if (!isRunning) {
        isRunning = true;
        timerInterval = setInterval(updateTimer, 1000);
    }
});

// Pause the timer
pauseButton.addEventListener("click", () => {
    clearInterval(timerInterval);
    isRunning = false;
});

// Reset the timer
resetButton.addEventListener("click", () => {
    clearInterval(timerInterval);
    isRunning = false;
    isBreak = false;
    timeLeft = workTime;
    updateDisplay();
    statusText.textContent = "Time to Focus!";
});

// Apply new settings
applySettingsButton.addEventListener("click", () => {
    saveSettings();
});

// Update the timer every second
function updateTimer() {
    if (timeLeft > 0) {
        timeLeft--;
        updateDisplay();
    } else {
        clearInterval(timerInterval);
        isRunning = false;
        isBreak = !isBreak;

        if (isBreak) {
            if (breakSound) breakSound.play();
            timeLeft = breakTime;
            statusText.textContent = "Time for a Break!";
        } else {
            if (focusSound) focusSound.play();
            timeLeft = workTime;
            sessionCount++;
            sessionCountDisplay.textContent = sessionCount;
            statusText.textContent = "Time to Focus!";
        }

        timerInterval = setInterval(updateTimer, 1000);
    }
}

// Update the timer display
function updateDisplay() {
    const minutes = Math.floor(timeLeft / 60);
    const seconds = timeLeft % 60;
    timeDisplay.textContent = `${minutes.toString().padStart(2, "0")}:${seconds
        .toString()
        .padStart(2, "0")}`;
}

// Load settings on page load
document.addEventListener("DOMContentLoaded", loadSettings);
