function scrollToBottom() {
    const container = document.querySelector(".second-section"); // change selector
    container.scrollIntoView({
        behavior: "smooth",
        block: "end"
    });
}

document.addEventListener("DOMContentLoaded", function () {
    // Audio //
    const homeAudio = document.getElementById("home-audio");
    const homeToggle = document.getElementById("home-audio-toggle");
    const overlay = document.getElementById("overlay");
    const toaster = document.getElementById("toaster");
    const toasterBtn = document.getElementById("toasterBtn");

    function setupToggle(audio, button, allButtons) {
        if (!button) return;
        button.addEventListener("click", () => {
            if (audio.muted) {
                audio.muted = false;
                audio.play().catch(() => { });
                allButtons.forEach(btn => {
                    btn.querySelector(".audio-text").textContent = "Mute";
                    btn.querySelector(".volume").classList.add("active");
                    btn.querySelector(".mute").classList.remove("active");
                });
            } else {
                audio.muted = true;
                allButtons.forEach(btn => {
                    btn.querySelector(".audio-text").textContent = "Unmute";
                    btn.querySelector(".volume").classList.remove("active");
                    btn.querySelector(".mute").classList.add("active");
                });
            }
        });
    }

    setupToggle(homeAudio, homeToggle, [homeToggle]);

    toasterBtn.addEventListener("click", () => {
        overlay.style.display = "none";
        toaster.style.display = "none";
        homeAudio.muted = false;
        homeAudio.play().catch(() => { });
    });

    // Form Validation //
    const usernameInput = document.getElementById("username");
    const emailInput = document.getElementById("emailInput");
    const emailError = document.getElementById("emailErr");
    const checkbox = document.getElementById("inlineCheckbox");
    const nextBtn = document.getElementById("nextBtn");
    const missionBtn = document.getElementById("missionBtn");

    const inputError = document.getElementById("inputErr");
    const checkboxError = document.getElementById("checkboxErr");

    let emailTouched = false;
    // Hide error on load
    emailError.style.display = "none";
    inputError.style.display = "none";
    checkboxError.style.display = "none";

    function validateForm() {
        const nicknameValid = usernameInput.value.trim() !== "";
        const emailValid = emailInput.checkValidity();
        const checkboxChecked = checkbox.checked;

        // Toggle button enable/disable
        nextBtn.disabled = !(nicknameValid && emailValid && checkboxChecked);

        // Toggle error messages
        inputError.style.display = (!nicknameValid || !emailValid) ? "block" : "none";
        checkboxError.style.display = !checkboxChecked ? "block" : "none";
    }

    function toggleEmailError() {
        emailError.style.display = emailInput.validity.valid ? "none" : "block";
    }

    emailInput.addEventListener("blur", () => {
        emailTouched = true;
        toggleEmailError();
    });

    emailInput.addEventListener("input", () => {
        if (emailTouched) toggleEmailError();
        validateForm();
    });

    usernameInput.addEventListener("input", validateForm);
    checkbox.addEventListener("change", validateForm);

    nextBtn.addEventListener("click", function (e) {
        e.preventDefault();
        validateForm();

        const nicknameValid = usernameInput.value.trim() !== "";
        const emailValid = emailInput.checkValidity();
        const checkboxChecked = checkbox.checked;
        if (nicknameValid && emailValid && checkboxChecked) {
            missionBtn.textContent = "Continue Missions";
            missionBtn.setAttribute("data-bs-target", "#missionModal");
        }
    });

    // Countdown Timer //
    const today = new Date();
    const unlockDate = new Date("2025-09-29T00:00:00");
    const finalMission = document.getElementById("final-mission");
    const countdownEl = document.getElementById("final-countdown");
    const btn = finalMission.querySelector(".accordion-button");

    if (today < unlockDate) {
        const diffTime = unlockDate - today;
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        countdownEl.textContent = `Unlock in ${diffDays} days`;
    } else {
        finalMission.classList.remove("locked");
        btn.removeAttribute("disabled");
        if (countdownEl) countdownEl.remove();
    }
});

function formatNumber(n) {
    return n.toString().padStart(2, '0');
}

const missions = {
    1: { total: 1, completed: 0 },
    2: { total: 2, completed: 0 },
    3: { total: 1, completed: 0 },
};

document.querySelectorAll('.task-card').forEach(card => {
    card.addEventListener('click', () => {
        const mission = card.dataset.mission;
        const statusText = card.querySelector('.status-text');

        if (!card.classList.contains('complete')) {
            card.classList.add('complete');
            statusText.textContent = "DONE";
            missions[mission].completed++;
        } else {
            card.classList.remove('complete');
            statusText.textContent = "GO";
            missions[mission].completed--;
        }

        const progress = document.getElementById(`mission${mission}-progress`);

        if (missions[mission].completed === missions[mission].total) {
            progress.textContent = "Completed";
            progress.classList.add("completed");
        } else {
            progress.textContent = `${formatNumber(missions[mission].completed)}/${formatNumber(missions[mission].total)}`;
            progress.classList.remove("completed");
        }

        const statusLabel = document.getElementById(`mission${mission}-status`);
        const desc = document.getElementById(`mission${mission}-desc`);
        const lockIcon = statusLabel.querySelector(".lock-icon");

        if (missions[mission].completed === missions[mission].total) {
            statusLabel.classList.add("bonus-unlocked");
            statusLabel.classList.remove("bonus-locked");

            if (lockIcon) lockIcon.style.display = "none";
            statusLabel.querySelector(".status-label").textContent = "Bonus Prize Unlocked!";
            desc.innerHTML = "You have completed your tasks! <br> Unlock and claim your bonus prize.";
        } else {
            statusLabel.classList.add("bonus-locked");
            statusLabel.classList.remove("bonus-unlocked");

            if (lockIcon) lockIcon.style.display = "inline-block";
            statusLabel.querySelector(".status-label").textContent = "Bonus Prize Locked";
            desc.textContent = `Complete all ${missions[mission].total} task(s) to unlock a bonus prize!`;
        }

        updateProgressBar();
    });
});

// document.querySelectorAll('.bonus-status').forEach(statusEl => {
//     statusEl.addEventListener('click', () => {
//         if (statusEl.classList.contains('bonus-unlocked')) {
//             let prizeModal = new bootstrap.Modal(document.getElementById("prizeDownloadModal"), {
//                 backdrop: false,
//                 keyboard: false
//             });
//             prizeModal.show();
//         }
//     });
// });

const imgTint = document.getElementById('imgTint');
const progressText = document.getElementById('progressText');
imgTint.addEventListener('click', () => {
    const isVisible = progressText && window.getComputedStyle(progressText).display != 'none' && progressText.textContent.trim() != '';
    if (isVisible) {
        const unlockModal = new bootstrap.Modal(unlockLuckyDraw, {
            backdrop: false,   // keeps first modal visible
            keyboard: false
        });
        unlockModal.show();
    }
});

function updateProgressBar() {
    const prizeImg = document.getElementById('prizeImg');
    const globalBar = document.querySelector('.progress-bar');
    const progressPercent = document.getElementById('progressPercent');
    const allTasks = document.querySelectorAll('.task-card').length;
    const doneTasks = document.querySelectorAll('.task-card.complete').length;
    const luckyDrawText = document.getElementById('luckyDrawText');
    const luckyDrawBtn = document.getElementById('luckyDrawBtn');

    const percent = (doneTasks / allTasks) * 100;
    const remaining = allTasks - doneTasks;

    globalBar.style.width = percent + "%";
    globalBar.setAttribute("aria-valuenow", percent.toFixed(2));
    progressPercent.textContent = `${Math.round(percent)}%`;

    if (percent >= 100) {
        progressPercent.classList.add("complete");
    } else {
        progressPercent.classList.remove("complete");
    }

    if (remaining > 0) {
        luckyDrawText.textContent = "Complete all tasks to unlock Lucky Draw!";
        progressText.textContent = `Complete ${remaining.toString().padStart(2, "0")} task${remaining > 1 ? 's' : ''} to unlock!`;
        prizeImg.src = 'img/prize-locked.png';
        luckyDrawBtn.style.display = 'none';
    } else {
        luckyDrawText.textContent = "You've completed all your tasks!";
        progressText.textContent = "";
        prizeImg.src = 'img/prize.png';
        luckyDrawBtn.style.display = 'block';
    }
}

document.getElementById('luckyDrawBtn').addEventListener('click', function (e) {
    e.preventDefault();

    const unlockLuckyDrawModal = new bootstrap.Modal(luckyDrawModal, {
        backdrop: false,
        keyboard: false
    });
    unlockLuckyDrawModal.show();
});

// Drag & drop & File Upload //
const dropArea = document.getElementById("dropArea");
const fileInput = document.getElementById("fileInput");
const browseBtn = document.getElementById("browseBtn");
const fileList = document.getElementById("fileList");
const receiptSubmitted = document.getElementById("receipt-submitted");

browseBtn.addEventListener("click", () => fileInput.click());
fileInput.addEventListener("change", () => {
    handleFiles(fileInput.files);
});

["dragenter", "dragover"].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.add("highlight");
    });
});
["dragleave", "drop"].forEach(eventName => {
    dropArea.addEventListener(eventName, e => {
        e.preventDefault();
        e.stopPropagation();
        dropArea.classList.remove("highlight");
    });
});
dropArea.addEventListener("drop", e => {
    const dt = e.dataTransfer;
    const files = dt.files;
    handleFiles(files);
});

function handleFiles(files) {
    fileList.innerHTML = "";
    let validFileCount = 0;
    [...files].forEach(file => {
        if (!validateFile(file)) return;

        const li = document.createElement("li");
        li.textContent = file.name;
        fileList.appendChild(li);
        validFileCount++;
    });
    receiptSubmitted.textContent = String(validFileCount).padStart(2, "0");
}

function validateFile(file) {
    const validTypes = ["image/jpeg", "image/png", "application/pdf"];
    if (!validTypes.includes(file.type)) {
        alert(`${file.name} is not a valid file type.`);
        return false;
    }
    return true;
}

const taskLinks = {
    task1: "https://cpn.sega-account.com/",
    task2: "https://www.facebook.com/Atlus.asia/",
    task3: "https://www.instagram.com/atlus.sea/",
    task4: "https://discord.com/invite/atlussea"
};
Object.keys(taskLinks).forEach(taskId => {
    const el = document.getElementById(taskId);
    if (el) {
        el.addEventListener("click", () => {
            window.open(taskLinks[taskId], "_blank");
        });
    }
});

function downloadImage() {
    const link = document.createElement('a');
    link.href = 'img/download-prize.png';
    link.download = 'download-prize.png';
    link.click();
}
