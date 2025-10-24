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

function updateEntriesFromAPI(missions) {
    const entries = calculateEntries(missions);
    const entriesDisplay = document.getElementById('entriesCount');

    if (entriesDisplay) entriesDisplay.textContent = entries;
    sessionStorage.setItem('entriesCount', entries);
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

async function logout() {
    try {
        const response = await fetch('/logout', {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json",
            },
        });

        if (!response.ok) {
            console.error("Logout request failed with status:", response.status);
            return;
        }

        const data = await response.json();

        if (data.success) {
            sessionStorage.clear();
            window.location.href = "/";
        } else {
            console.warn("Logout unsuccessful:", data);
        }
    } catch (err) {
        console.error("Logout failed:", err);
    }
}




