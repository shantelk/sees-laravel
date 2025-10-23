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

    // setupToggle(homeAudio, homeToggle, [homeToggle]);

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



    // document.querySelectorAll('.task-card').forEach(card => {
    //     card.addEventListener('click', () => {
    //         const mission = card.dataset.mission;
    //         const statusText = card.querySelector('.status-text');
    //         const progress = document.getElementById(`mission${mission}-progress`);

    //         if (!card.classList.contains('complete')) {
    //             card.classList.add('complete');
    //             statusText.textContent = "DONE";
    //             missions[mission].completed++;
    //         } else {
    //             card.classList.remove('complete');
    //             statusText.textContent = "GO";
    //             missions[mission].completed--;
    //         }

    //         progress.textContent = `${formatNumber(missions[mission].completed)}/${formatNumber(missions[mission].total)}`;
    //         progress.classList.remove("completed");

    //         const statusLabel = document.getElementById(`mission${mission}-status`);
    //         const desc = document.getElementById(`mission${mission}-desc`);
    //         const lockIcon = statusLabel?.querySelector(".lock-icon");

    //         if (missions[mission].completed === missions[mission].total) {
    //             completeMission(mission);
    //         } else {
    //             if (statusLabel) {
    //                 statusLabel.classList.add("bonus-locked");
    //                 statusLabel.classList.remove("bonus-unlocked");
    //                 const label = statusLabel.querySelector(".status-label");
    //                 if (label) label.textContent = "Bonus Prize Locked";
    //             }
    //             if (lockIcon) lockIcon.style.display = "inline-block";
    //             if (desc) desc.textContent = `Complete all ${missions[mission].total} task(s) to unlock a bonus prize!`;
    //         }

    //         updateLuckyDrawSection();
    //     });
    // });

    // const userData = sessionStorage.getItem('user_data');

    // if (userData) {
    //     const parsed = JSON.parse(userData);
    //     const missions = parsed.missions; // from your login API

    //     // Update entries using the same helper function
    //     updateEntriesFromAPI(missions);
    // } else {
    //     // fallback: if user directly visited /missions
    //     const entries = sessionStorage.getItem('entriesCount') || 0;
    //     document.getElementById('entriesCount').textContent = entries;
    // }

    // // Modal sync
    // const entryModal = document.getElementById('entryModal');
    // const modalEntries = document.getElementById('modalEntriesCount');
    // if (entryModal) {
    //     entryModal.addEventListener('show.bs.modal', () => {
    //         const entries = sessionStorage.getItem('entriesCount') || 0;
    //         modalEntries.textContent = entries;
    //     });
    // }

    // function onReceiptUploaded() {
    //     completeMission(4);
    // }


    // document.querySelectorAll('.bonus-status').forEach(el => {
    //     el.addEventListener('click', () => {
    //         if (el.classList.contains('bonus-unlocked')) {
    //             const missionId = el.dataset.id;
    //             const modalEl = document.getElementById(`prizeModal${missionId}`);
    //             const prizeModal = new bootstrap.Modal(modalEl, {
    //                 backdrop: false,
    //                 keyboard: false
    //             });
    //             prizeModal.show();
    //         }
    //     });
    // });

    // const imgTint = document.getElementById('imgTint');
    // if (imgTint) {
    //     imgTint.addEventListener('click', () => {
    //         if (imgTint.classList.contains('locked')) {
    //             const unlockModal = new bootstrap.Modal(document.getElementById("errorUnlockModal"), {
    //                 backdrop: false,
    //                 keyboard: false
    //             });
    //             unlockModal.show();
    //         }
    //     });
    // }

    // // Drag & drop & File Upload //
    // const dropArea = document.getElementById("dropArea");
    // const fileInput = document.getElementById("fileInput");
    // const browseBtn = document.getElementById("browseBtn");
    // const fileBox = document.getElementById("fileBox");
    // const fileName = fileBox.querySelector(".file-name");
    // const fileSize = fileBox.querySelector(".file-size");
    // const uploadStatus = fileBox.querySelector(".upload-status");
    // const progressBar = fileBox.querySelector(".progress-bar");
    // const progressPercent = document.getElementById("progressPercent");
    // const deleteFileBtn = document.getElementById("deleteFileBtn");
    // const receiptSubmitted = document.getElementById("receipt-submitted");
    // const bonusStatus = document.getElementById("mission4-status");
    // const bonusLabel = bonusStatus.querySelector(".status-label");

    // browseBtn.addEventListener("click", () => fileInput.click());
    // fileInput.addEventListener("change", () => {
    //     handleFiles(fileInput.files);
    // });

    // ["dragenter", "dragover"].forEach(eventName => {
    //     dropArea.addEventListener(eventName, e => {
    //         e.preventDefault();
    //         e.stopPropagation();
    //         dropArea.classList.add("highlight");
    //     });
    // });
    // ["dragleave", "drop"].forEach(eventName => {
    //     dropArea.addEventListener(eventName, e => {
    //         e.preventDefault();
    //         e.stopPropagation();
    //         dropArea.classList.remove("highlight");
    //     });
    // });
    // dropArea.addEventListener("drop", e => {
    //     const dt = e.dataTransfer;
    //     const files = dt.files;
    //     handleFiles(files);
    // });

    // function handleFiles(files) {
    //     const file = files[0];
    //     if (!file || !validateFile(file)) return;

    //     dropArea.classList.add("d-none");
    //     fileBox.classList.remove("d-none");

    //     fileName.textContent = file.name;
    //     fileSize.textContent = `${Math.round(file.size / 1024)} kb`;

    //     startFakeUpload(file);
    // }

    // // TODO: replace startFakeUpload() with startRealUpload() when backend API is ready
    // function startFakeUpload(file) {
    //     let progress = 0;

    //     const fileNameEl = document.querySelector(".file-name");
    //     const fileSizeEl = document.querySelector(".file-size");
    //     const uploadStatus = document.querySelector(".upload-status");
    //     const progressBar = document.getElementById("progressBar");
    //     const progressPercent = document.getElementById("progressPercent");
    //     const progressBox = document.querySelector(".progress");

    //     if (fileNameEl) fileNameEl.textContent = file.name;
    //     if (fileSizeEl) fileSizeEl.textContent = "-";

    //     if (uploadStatus) {
    //         uploadStatus.textContent = "Uploading...";
    //         uploadStatus.classList.remove("text-success", "text-danger", "d-none");
    //         uploadStatus.classList.add("text-cyan");
    //         uploadStatus.style.opacity = "1";
    //     }

    //     if (progressBox) progressBox.classList.remove("d-none");
    //     if (progressBar) progressBar.style.width = "0%";
    //     if (progressPercent) {
    //         progressPercent.textContent = "0%";
    //         progressPercent.classList.remove("d-none");
    //     }

    //     const uploadInterval = setInterval(() => {
    //         progress += 25 + Math.random() * 25;
    //         if (progress >= 100) progress = 100;

    //         if (progressBar) progressBar.style.width = `${progress}%`;
    //         if (progressPercent) progressPercent.textContent = `${Math.floor(progress)}%`;

    //         if (uploadStatus) uploadStatus.textContent = "Uploading...";

    //         if (progress >= 100) {
    //             clearInterval(uploadInterval);

    //             if (uploadStatus) {
    //                 uploadStatus.textContent = "Complete ✓";
    //                 uploadStatus.classList.remove("text-cyan");
    //                 uploadStatus.classList.add("text-success");
    //             }

    //             if (fileSizeEl) {
    //                 const sizeKB = file.size / 1024;
    //                 const readableSize = sizeKB > 1024 ? (sizeKB / 1024).toFixed(2) + " MB" : sizeKB.toFixed(1) + " KB";
    //                 fileSizeEl.textContent = readableSize;
    //             }

    //             setTimeout(() => {
    //                 if (uploadStatus) uploadStatus.classList.add("d-none");
    //                 if (progressBox) progressBox.classList.add("d-none");
    //                 if (progressPercent) progressPercent.classList.add("d-none");
    //             }, 500);

    //             const submissionEl = document.querySelector(".submission");
    //             const missionId = Number(submissionEl?.dataset.mission) || 4;
    //             completeMission(missionId);
    //             onReceiptUploaded();
    //         }
    //     }, 200);
    // }

    // deleteFileBtn.addEventListener("click", () => {
    //     fileBox.classList.add("d-none");
    //     dropArea.classList.remove("d-none");
    //     fileInput.value = "";
    //     progressBar.style.width = "0%";
    //     progressPercent.textContent = "0%";
    //     receiptSubmitted.textContent = "00";

    //     bonusStatus.classList.remove("bonus-unlocked");
    //     bonusStatus.classList.add("bonus-locked");
    //     bonusLabel.textContent = "BONUS PRIZE LOCKED";
    //     incompleteMission(4);
    // });

    // function validateFile(file) {
    //     const validTypes = ["image/jpeg", "image/png", "application/pdf"];
    //     if (!validTypes.includes(file.type)) {
    //         alert(`${file.name} is not a valid file type.`);
    //         return false;
    //     }
    //     return true;
    // }

    // const luckyDrawBtn = document.getElementById('luckyDrawBtn');
    // const entryModalEl = document.getElementById('entryModal');
    // const entryBtn = document.getElementById('entryBtn');
    // const backBtn = document.getElementById('backBtn');
    // const modalInstance = new bootstrap.Modal(entryModalEl);
    // const emText = document.getElementById('emText');

    // let hasSubmitted = false;

    // luckyDrawBtn.addEventListener('click', (e) => {
    //     e.preventDefault();

    //     entryModalEl.querySelector('.step-1').classList.remove('d-none');
    //     entryModalEl.querySelector('.step-2').classList.add('d-none');

    //     if (hasSubmitted) {
    //         entryBtn.disabled = true;
    //         entryBtn.textContent = "Entries Submitted";
    //         emText.textContent = "You have submitted accumulated entries of  [4] for the draw."
    //         backBtn.classList.remove('d-none');
    //     } else {
    //         entryBtn.disabled = false;
    //         entryBtn.textContent = "Submit Entries (4)";
    //         emText.textContent = "You have completed [4] mission(s), and have accumulated entries of  [4] for the draw."
    //         backBtn.classList.add('d-none');
    //     }
    //     modalInstance.show();
    // });

    // entryBtn.addEventListener('click', () => {
    //     if (entryBtn.disabled) return;

    //     entryModalEl.querySelector('.step-1').classList.add('d-none');
    //     entryModalEl.querySelector('.step-2').classList.remove('d-none');
    //     hasSubmitted = true;
    // });

    // entryModalEl.addEventListener('hidden.bs.modal', () => {
    //     if (hasSubmitted) {
    //         luckyDrawBtn.textContent = "Check Entries";
    //         luckyDrawBtn.classList.add('btn-check-entries');
    //     }
    // });


    document.addEventListener('click', (e) => {
        const btn = e.target.closest('button[data-file]');
        if (!btn) return;
        const url = btn.dataset.file;
        const a = document.createElement('a');

        a.href = url;
        a.setAttribute('download', url.split('/').pop());
        document.body.appendChild(a);
        a.click();
        a.remove();
    });
});

function downloadCover() {
    const link = document.createElement('a');
    link.href = 'img/paper-cover.jpg';
    link.download = 'paper-cover.png';
    link.click();
}

async function submitEmail(type) {
    const username = document.getElementById(`${type}Username`).value.trim();
    const email = document.getElementById(`${type}Email`).value.trim();

    try {
        const api = await fetch('/api/submit-email', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({ username: username, email: email })
        });

        const res = await api.json();

        if (!api.ok) throw new Error(res.error || 'Request failed.');
        if (res.success) {
            console.log('✅ Success:', res);
            sessionStorage.setItem('api_token', res.data.api_token);
            sessionStorage.setItem('user_data', JSON.stringify(res.data));
            updateEntriesFromAPI(res.data.missions);

            const modalEl = document.getElementById(`${type}Modal`);
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            window.location.href = '/missions';
        }
    } catch (err) {
        console.error(err);
        alert(`${type} failed: ${err.message}`);
    }
}

function groupMissions(missions) {
    const grouped = {};

    Object.entries(missions).forEach(([key, value]) => {
        // take only the prefix before "_a"
        const missionKey = key.split('_')[0];
        if (!grouped[missionKey]) grouped[missionKey] = [];
        grouped[missionKey].push(value);
    });

    return grouped;
}

function calculateEntries(missions) {
    const grouped = groupMissions(missions);
    let entries = 0;

    for (const key in grouped) {
        const allComplete = grouped[key].every(v => v === true);
        if (allComplete) entries++;
    }

    return entries;
}

function updateEntriesFromAPI(missions) {
    const entries = calculateEntries(missions);

    // update mission page display
    const entriesDisplay = document.getElementById('entriesCount');
    if (entriesDisplay) entriesDisplay.textContent = entries;

    // store in sessionStorage for modal
    sessionStorage.setItem('entriesCount', entries);
}





