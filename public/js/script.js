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

    // toasterBtn.addEventListener("click", () => {
    //     overlay.style.display = "none";
    //     toaster.style.display = "none";
    //     homeAudio.muted = false;
    //     homeAudio.play().catch(() => { });
    // });

    // Form Validation //
    function isEmailValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    const loginModal = document.querySelector('[data-page="login"]');
    if (loginModal) {
        const username = loginModal.querySelector("#loginUsername");
        const email = loginModal.querySelector("#loginEmail");
        const nextBtn = loginModal.querySelector("#loginNextBtn");
        const loginErr = loginModal.querySelector("#loginErr");

        loginErr.style.display = "none";

        function validateLogin() {
            const validUser = username.value.trim() !== "";
            const validEmail = isEmailValid(email.value.trim());

            if (!validUser || !validEmail) {
                loginErr.style.display = "block";
                nextBtn.disabled = true;
            } else {
                loginErr.style.display = "none";
                nextBtn.disabled = false;
            }
        }
        username.addEventListener("input", validateLogin);
        email.addEventListener("input", validateLogin);
    }

    const signupModal = document.querySelector('[data-page="signup"]');
    if (signupModal) {
        const username = signupModal.querySelector("#signupUsername");
        const email = signupModal.querySelector("#signupEmail");
        const checkbox = signupModal.querySelector("#signupCheckbox");
        const nextBtn = signupModal.querySelector("#signupNextBtn");
        const inputErr = signupModal.querySelector("#signupInputErr");
        const emailErr = signupModal.querySelector("#signupEmailErr");
        const checkboxErr = signupModal.querySelector("#signupCheckboxErr");

        [inputErr, emailErr, checkboxErr].forEach(el => (el.style.display = "none"));

        function validateSignup() {
            const validUser = username.value.trim() !== "";
            const validEmail = isEmailValid(email.value.trim());
            const checked = checkbox.checked;

            inputErr.style.display = (!validUser || !validEmail) ? "block" : "none";
            emailErr.style.display = (email.value && !validEmail) ? "block" : "none";
            checkboxErr.style.display = !checked ? "block" : "none";

            nextBtn.disabled = !(validUser && validEmail && checked);
        }
        username.addEventListener("input", validateSignup);
        email.addEventListener("input", validateSignup);
        checkbox.addEventListener("change", validateSignup);
    }

    // Countdown Timer //
    // const today = new Date();
    // const unlockDate = new Date("2025-09-29T00:00:00");
    // const finalMission = document.getElementById("final-mission");
    // const countdownEl = document.getElementById("final-countdown");
    // const btn = finalMission.querySelector(".accordion-button");

    // if (today < unlockDate) {
    //     const diffTime = unlockDate - today;
    //     const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    //     countdownEl.textContent = `Unlock in ${diffDays} days`;
    // } else {
    //     finalMission.classList.remove("locked");
    //     btn.removeAttribute("disabled");
    //     if (countdownEl) countdownEl.remove();
    // }

    function formatNumber(n) {
        return n.toString().padStart(2, '0');
    }

    const missions = {
        1: { total: 1, completed: 0 },
        2: { total: 2, completed: 0 },
        3: { total: 1, completed: 0 },
        4: { total: 1, completed: 0 }
    };

    // refine ? //
    /**
     * Update mission progress, unlock bonuses, and trigger Lucky Draw eligibility.
     * @param {number} missionId - The mission ID (e.g., 1, 2, 3, 4)
     */

    function completeMission(missionId) {
        if (!missions[missionId]) return;

        // ✅ Mark completed
        missions[missionId].completed = missions[missionId].total;

        // ✅ Update progress text
        const progressEl = document.getElementById(`mission${missionId}-progress`) || document.getElementById('receipt-submitted');
        if (progressEl) {
            progressEl.textContent = "Completed";
            progressEl.classList.add("completed");
        }

        // ✅ Unlock bonus status
        const statusEl = document.getElementById(`mission${missionId}-status`);
        const descEl = document.getElementById(`mission${missionId}-desc`);
        const lockIcon = statusEl?.querySelector(".lock-icon");

        if (statusEl) {
            statusEl.classList.remove("bonus-locked");
            statusEl.classList.add("bonus-unlocked");
            statusEl.querySelector(".status-label").textContent = "Bonus Prize Unlocked!";
        }
        if (lockIcon) lockIcon.style.display = "none";
        if (descEl) descEl.innerHTML = "You have completed your tasks! <br> Unlock and claim your bonus prize.";

        // ✅ Trigger Lucky Draw enable
        updateLuckyDrawButton();
    }

    function updateLuckyDrawButton() {
        const completedMissions = Object.values(missions).filter(m => m.completed >= m.total).length;
        const luckyBtn = document.getElementById("luckyDrawBtn");
        if (!luckyBtn) return;

        if (completedMissions >= 1) {
            luckyBtn.disabled = false;
            luckyBtn.classList.remove("disabled");
        } else {
            luckyBtn.disabled = true;
            luckyBtn.classList.add("disabled");
        }
    }

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
                completeMission(mission);
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

            updateProgress();
        });
    });

    //////////////


    document.querySelectorAll('.bonus-status').forEach(el => {
        el.addEventListener('click', () => {
            if (el.classList.contains('bonus-unlocked')) {
                const missionId = el.dataset.id;
                const modalEl = document.getElementById(`prizeModal${missionId}`);
                const prizeModal = new bootstrap.Modal(modalEl, {
                    backdrop: false,
                    keyboard: false
                });
                prizeModal.show();
            }
        });
    });



    const imgTint = document.getElementById('imgTint');
    const progressText = document.getElementById('progressText');
    imgTint.addEventListener('click', () => {
        const isVisible = progressText && window.getComputedStyle(progressText).display != 'none' && progressText.textContent.trim() != '';
        if (isVisible) {
            const unlockModal = new bootstrap.Modal(document.getElementById("errorUnlockModal"), {
                backdrop: false,   // keeps first modal visible
                keyboard: false
            });
            unlockModal.show();
        }
    });

    function updateProgress() {
        const prizeImg = document.getElementById('prizeImg');
        const allTasks = document.querySelectorAll('.task-card').length;
        const doneTasks = document.querySelectorAll('.task-card.complete').length;
        const luckyDrawText = document.getElementById('luckyDrawText');
        const luckyDrawBtn = document.getElementById('luckyDrawBtn');

        const percent = (doneTasks / allTasks) * 100;
        const remaining = allTasks - doneTasks;

        if (doneTasks >= 1 && doneTasks < allTasks) {
            luckyDrawText.textContent = "Complete missions to accumulate entry chances!";
            progressText.textContent = "";
            prizeImg.src = 'img/prize-v2.png';
            luckyDrawBtn.removeAttribute('disabled');
            // luckyDrawBtn.style.display = 'none';
        } else if (doneTasks === allTasks) {
            luckyDrawText.textContent = "You've completed all mission(s)!";
            progressText.textContent = "";
            prizeImg.src = 'img/prize-v2.png';
            luckyDrawBtn.removeAttribute('disabled');
        } else {
            luckyDrawText.textContent = "Complete missions to accumulate entry chances!";
            progressText.textContent = "Complete a mission to unlock!";
            prizeImg.src = 'img/prize-v2-locked.png';
            luckyDrawBtn.setAttribute('disabled', 'true');
        }
    }




    // Drag & drop & File Upload //
    const dropArea = document.getElementById("dropArea");
    const fileInput = document.getElementById("fileInput");
    const browseBtn = document.getElementById("browseBtn");
    const fileBox = document.getElementById("fileBox");
    const fileName = fileBox.querySelector(".file-name");
    const fileSize = fileBox.querySelector(".file-size");
    const uploadStatus = fileBox.querySelector(".upload-status");
    const progressBar = fileBox.querySelector(".progress-bar");
    const progressPercent = document.getElementById("progressPercent");
    const deleteFileBtn = document.getElementById("deleteFileBtn");
    const receiptSubmitted = document.getElementById("receipt-submitted");
    const bonusStatus = document.getElementById("mission4-status");
    const bonusLabel = bonusStatus.querySelector(".status-label");

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
        const file = files[0];
        if (!file || !validateFile(file)) return;

        dropArea.classList.add("d-none");
        fileBox.classList.remove("d-none");

        // Show file info
        fileName.textContent = file.name;
        fileSize.textContent = `${Math.round(file.size / 1024)} kb`;

        startFakeUpload(file);
    }

    // TODO: replace startFakeUpload() with startRealUpload() when backend API is ready
    function startFakeUpload(file) {
        let progress = 0;
        uploadStatus.textContent = "Uploading...";
        uploadStatus.classList.remove("text-success", "text-danger");
        progressBar.style.width = "0%";
        progressPercent.textContent = "0%";

        progressBar.parentElement.classList.remove("d-none");
        progressPercent.classList.remove("d-none");

        const uploadInterval = setInterval(() => {
            progress += Math.random() * 15; // simulate variable speed
            if (progress >= 100) progress = 100;

            progressBar.style.width = `${progress}%`;
            progressPercent.textContent = `${Math.floor(progress)}%`;

            if (progress < 100) {
                uploadStatus.textContent = `Uploading...`;
            } else {
                clearInterval(uploadInterval);

                // simulate random fail/success
                const success = Math.random() > 0.15; // simulate random failure
                uploadStatus.classList.remove("text-cyan");
                if (success) {


                    uploadStatus.textContent = "Complete ✓";
                    uploadStatus.classList.add("text-success");
                    progressPercent.textContent = "100%";

                    setTimeout(() => {
                        progressBar.parentElement.classList.add("d-none");
                        progressPercent.classList.add("d-none");
                        uploadStatus.classList.add("d-none");
                    }, 1000);

                    const submissionEl = document.querySelector('.submission');
                    const missionId = Number(submissionEl?.dataset.mission);
                    completeMission(missionId);


                    receiptSubmitted.textContent = "01";
                    // bonusStatus.classList.remove("bonus-locked");
                    // bonusStatus.classList.add("bonus-unlocked");
                    // bonusLabel.textContent = "BONUS PRIZE UNLOCKED!";
                } else {
                    uploadStatus.textContent = "Upload failed ✗ ";
                    uploadStatus.classList.add("text-danger");
                    progressPercent.textContent = "0%";
                }
            }
        }, 400);
    }

    // Done //
    deleteFileBtn.addEventListener("click", () => {
        fileBox.classList.add("d-none");
        dropArea.classList.remove("d-none");
        fileInput.value = "";
        progressBar.style.width = "0%";
        progressPercent.textContent = "0%";
        receiptSubmitted.textContent = "00";

        bonusStatus.classList.remove("bonus-unlocked");
        bonusStatus.classList.add("bonus-locked");
        bonusLabel.textContent = "BONUS PRIZE LOCKED";
    });

    function validateFile(file) {
        const validTypes = ["image/jpeg", "image/png", "application/pdf"];
        if (!validTypes.includes(file.type)) {
            alert(`${file.name} is not a valid file type.`);
            return false;
        }
        return true;
    }

    const luckyDrawBtn = document.getElementById('luckyDrawBtn');
    const entryModalEl = document.getElementById('entryModal');
    const entryBtn = document.getElementById('entryBtn');
    const backBtn = document.getElementById('backBtn');
    const modalInstance = new bootstrap.Modal(entryModalEl);

    let hasSubmitted = false;

    luckyDrawBtn.addEventListener('click', (e) => {
        e.preventDefault();

        // Always reset to Step 1 when modal opens
        entryModalEl.querySelector('.step-1').classList.remove('d-none');
        entryModalEl.querySelector('.step-2').classList.add('d-none');

        if (hasSubmitted) {
            entryBtn.disabled = true;
            entryBtn.textContent = "Entries Submitted";
            backBtn.classList.remove('d-none');
        } else {
            entryBtn.disabled = false;
            entryBtn.textContent = "Submit Entries (4)";
            backBtn.classList.add('d-none');
        }

        modalInstance.show();
    });

    entryBtn.addEventListener('click', () => {
        if (entryBtn.disabled) return;

        // Switch to Step 2
        entryModalEl.querySelector('.step-1').classList.add('d-none');
        entryModalEl.querySelector('.step-2').classList.remove('d-none');

        hasSubmitted = true;
    });

    // 🎯 When modal is closed after Step 2
    entryModalEl.addEventListener('hidden.bs.modal', () => {
        if (hasSubmitted) {
            luckyDrawBtn.textContent = "Check Entries";
            luckyDrawBtn.classList.add('btn-check-entries');
        }
    });


    // Sign Out
    document.getElementById('signoutBtn').addEventListener('click', function (e) {
        e.preventDefault();

        const signoutModal = new bootstrap.Modal(document.getElementById("signoutModal"), {
            backdrop: false,
            keyboard: false
        });
        signoutModal.show();

    });

    // const taskLinks = {
    //     task1: "https://cpn.sega-account.com/",
    //     task2: "https://www.facebook.com/Atlus.asia/",
    //     task3: "https://www.instagram.com/atlus.sea/",
    //     task4: "https://discord.com/invite/atlussea"
    // };
    // Object.keys(taskLinks).forEach(taskId => {
    //     const el = document.getElementById(taskId);
    //     if (el) {
    //         el.addEventListener("click", () => {
    //             window.open(taskLinks[taskId], "_blank");
    //         });
    //     }
    // });

    function downloadImage(url, filename) {
        const link = document.createElement('a');
        link.href = url;
        link.download = filename || 'bonus-prize';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

});
