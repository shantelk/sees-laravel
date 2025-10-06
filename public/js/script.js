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
    const emailInput = document.getElementById("emailInput");
    const errorMsg = emailInput.parentElement.querySelector("span");
    const checkbox = document.getElementById("inlineCheckbox");
    const nextBtn = document.getElementById("nextBtn");
    const missionBtn = document.getElementById("missionBtn");

    let emailTouched = false;

    function validateForm() {
        const emailValid = emailInput.checkValidity();
        const checkboxChecked = checkbox.checked;
        nextBtn.disabled = !(emailValid && checkboxChecked);
    }

    function toggleError() {
        if (emailInput.validity.valid) {
        errorMsg.style.display = "none";
        } else {
        errorMsg.style.display = "block";
        }
    }

    // Hide error on load
    errorMsg.style.display = "none";

    emailInput.addEventListener("blur", () => {
        emailTouched = true;
        toggleError();
    });

    emailInput.addEventListener("input", () => {
        validateForm();
        if (emailTouched) toggleError();
    });

    checkbox.addEventListener("change", validateForm);

    nextBtn.addEventListener("click", function () {
        missionBtn.textContent = "Continue Missions";
        missionBtn.setAttribute("data-bs-target", "#missionModal");
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
    2: { total: 3, completed: 0 },
    3: { total: 3, completed: 0 },
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
            desc.textContent = "You have completed all your tasks! Unlock to claim your bonus prize";
        } else {
            statusLabel.classList.add("bonus-locked");
            statusLabel.classList.remove("bonus-unlocked");

            if (lockIcon) lockIcon.style.display = "inline-block";
            statusLabel.querySelector(".status-label").textContent = "Bonus Prize Locked";
            desc.textContent = `Complete all ${missions[mission].total} task${missions[mission].total > 1 ? 's' : ''} to unlock bonus prize!`;
        }

        updateProgressBar();
    });

    document.querySelectorAll('.bonus-status').forEach(statusEl => {
        statusEl.addEventListener('click', () => {
            if (statusEl.classList.contains('bonus-unlocked')) {
                let prizeModal = new bootstrap.Modal(document.getElementById("prizeDownloadModal"), {
                    backdrop: false,
                    keyboard: false
                });
                prizeModal.show();
            }
        });
    });
    
    function updateProgressBar() {
        const allTasks = document.querySelectorAll('.task-card').length;
        const doneTasks = document.querySelectorAll('.task-card.complete').length;
        const globalBar = document.querySelector('.progress-bar');
        const percent = (doneTasks / allTasks) * 100;
        const luckyDrawText = document.getElementById('luckyDrawText');
        const remaining = allTasks - doneTasks;

        globalBar.style.width = percent + "%";
        globalBar.setAttribute("aria-valuenow", percent.toFixed(2));
        if (remaining > 0) {
            luckyDrawText.textContent = `${remaining.toString().padStart(2, "0")} more Task${remaining > 1 ? 's' : ''} Complete to unlock Lucky Draw`;
        } else {
            luckyDrawText.textContent = "Mission Complete!";
        }
    }

    // Drag & drop & File Upload //
    const dropArea = document.getElementById("dropArea");
    const fileInput = document.getElementById("fileInput");
    const browseBtn = document.getElementById("browseBtn");
    const fileList = document.getElementById("fileList");

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
        [...files].forEach(file => {
            if (!validateFile(file)) return;

            const li = document.createElement("li");
            li.textContent = file.name;
            fileList.appendChild(li);
        });
    }

    function validateFile(file) {
        const validTypes = ["image/jpeg", "image/png", "application/pdf"];
        if (!validTypes.includes(file.type)) {
            alert(`${file.name} is not a valid file type.`);
            return false;
        }
        return true;
    }
});

document.getElementById("task1").addEventListener("click", function () {
    window.open("https://cpn.sega-account.com/", "_blank");
});

function downloadImage() {
  const link = document.createElement('a');
  link.href = 'img/download-prize.png';
  link.download = 'download-prize.png';
  link.click();
}
