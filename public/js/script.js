function scrollToBottom() {
    const container = document.querySelector(".second-section");
    container.scrollIntoView({
        behavior: "smooth",
        block: "end"
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const homeAudio = document.getElementById("home-audio");
    const homeToggle = document.getElementById("home-audio-toggle");
    const overlay = document.getElementById("overlay");
    const toaster = document.getElementById("toaster");
    const toasterBtn = document.getElementById("toasterBtn");

    if (!homeAudio || !homeToggle) return;

    const hasAccepted = localStorage.getItem("cookieAccepted") === "true";
    let isMuted = localStorage.getItem("audioMuted");

    if (isMuted === null) {
        isMuted = "true";
        localStorage.setItem("audioMuted", "true");
    }

    homeAudio.muted = isMuted === "true";

    const updateAudioButtonUI = (muted) => {
        const text = homeToggle.querySelector(".audio-text");
        const volume = homeToggle.querySelector(".volume");
        const mute = homeToggle.querySelector(".mute");

        if (text) text.textContent = muted ? "Unmute" : "Mute";
        if (volume) volume.classList.toggle("active", !muted);
        if (mute) mute.classList.toggle("active", muted);
    };

    updateAudioButtonUI(homeAudio.muted);

    if (!hasAccepted) {
        overlay?.classList.remove("d-none");
        toaster?.classList.remove("d-none");
        overlay.style.display = "flex";
        toaster.style.display = "flex";
    } else {
        overlay?.classList.add("d-none");
        toaster?.classList.add("d-none");
        overlay.style.display = "none";
        toaster.style.display = "none";
    }

    if (hasAccepted && !homeAudio.muted) {
        homeAudio.play().catch(() => {
            console.log("Autoplay blocked (browser policy). Waiting for user interaction.");

            const resumeAudio = () => {
                if (!homeAudio.muted) {
                    homeAudio.play().catch(() => { });
                }
                document.removeEventListener("click", resumeAudio);
                document.removeEventListener("keydown", resumeAudio);
            };

            document.addEventListener("click", resumeAudio, { once: true });
            document.addEventListener("keydown", resumeAudio, { once: true });
        });
    }

    if (toasterBtn) {
        toasterBtn.addEventListener("click", () => {
            overlay.style.display = "none";
            toaster.style.display = "none";
            localStorage.setItem("cookieAccepted", "true");
            // stays muted until user manually unmutes
            updateAudioButtonUI(true);
        });
    }

    homeToggle.addEventListener("click", () => {
        const nowMuted = !homeAudio.muted;
        homeAudio.muted = nowMuted;
        localStorage.setItem("audioMuted", nowMuted);
        updateAudioButtonUI(nowMuted);

        if (!nowMuted) {
            homeAudio.play().catch(() => { });
            localStorage.setItem("cookieAccepted", "true");
        } else {
            homeAudio.pause();
        }
    });

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
    link.href = 'pdf/P3R_NSW2-Cover.pdf';
    link.download = 'P3R_NSW2 Cover.pdf';
    link.click();
}

async function submitAuth(type) {
    const username = document.getElementById(`${type}Username`).value.trim();
    const email = document.getElementById(`${type}Email`).value.trim();
    const endpoint = type === 'login' ? '/api/login' : '/api/register';
    const errorEl = document.getElementById(`${type}APIErr`);
    try {
        const response = await fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({ username, email })
        });

        const res = await response.json();

        if (!response.ok || !res.success) {
            throw new Error(res.message || 'Request failed.');
        }

        const userData = res.data;
        localStorage.setItem('api_token', userData.api_token);
        localStorage.setItem('user_data', JSON.stringify(userData));
        localStorage.setItem('token_expiry', Date.now() + 8 * 60 * 60 * 1000); //8h
        if (typeof updateEntriesFromAPI === 'function') {
            updateEntriesFromAPI(userData.missions);
        }

        const modalEl = document.getElementById(`${type}Modal`);
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        window.location.href = '/missions';
    } catch (err) {
        console.error(err);
        const title = type === 'login' ? 'Login failed.' : 'Register failed.';
        const message = err.message || 'Please try again later.';
        showErrorModal(title, message);

    }
}

function showErrorModal(title, message) {
    const modalEl = document.getElementById('errorModal');
    const titleEl = document.getElementById('errorTitle');
    const messageEl = document.getElementById('errorMessage');

    if (titleEl) titleEl.textContent = title;
    if (messageEl) messageEl.textContent = message;

    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// async function submitEmail(type) {
//     const username = document.getElementById(`${type}Username`).value.trim();
//     const email = document.getElementById(`${type}Email`).value.trim();

//     try {
//         const api = await fetch('/api/submit-email', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').content
//             },
//             body: JSON.stringify({ username: username, email: email })
//         });

//         const res = await api.json();

//         if (!api.ok) throw new Error(res.error || 'Request failed.');
//         if (res.success) {
//             localStorage.setItem('api_token', res.data.api_token);
//             localStorage.setItem('user_data', JSON.stringify(res.data));
//             updateEntriesFromAPI(res.data.missions);

//             const modalEl = document.getElementById(`${type}Modal`);
//             const modal = bootstrap.Modal.getInstance(modalEl);
//             if (modal) modal.hide();

//             window.location.href = '/missions';
//         }
//     } catch (err) {
//         console.error(err);
//         alert(`${type} failed: ${err.message}`);
//     }
// }

function updateEntriesFromAPI(missions) {
    const entries = calculateEntries(missions);
    const entriesDisplay = document.getElementById('entriesCount');

    if (entriesDisplay) entriesDisplay.textContent = entries;
    localStorage.setItem('entriesCount', entries);
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

function groupMissions(missions) {
    const grouped = {};

    Object.entries(missions).forEach(([key, value]) => {
        const missionKey = key.split('_')[0];
        if (!grouped[missionKey]) grouped[missionKey] = [];
        grouped[missionKey].push(value);
    });
    return grouped;
}

const TOKEN_MAX_AGE = 24 * 60 * 60 * 1000; // 24 hours in ms

async function logout() {
    try {
        await fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
        });
    } catch (err) {
        console.error('Logout failed:', err);
    } finally {
        localStorage.clear();
        window.location.replace('/');
    }
}




