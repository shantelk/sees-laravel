@extends('layouts.app')

@section('content')
<div id="missionModal">
    <div class="bg-image-modal">
        <div class="nav-bar text-white">
            <div class="d-flex justify-content-between w-100">
                <a href="/">
                    <img class="p3-logo cursor-pointer" src="img/p3.png">
                </a>
                <div class="d-flex items-center">
                    <div class="user-details">
                        <h6>{{ $username }}</h6>
                        <p>{{ $email }}</p>
                    </div>
                    <button id="signoutBtn" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path d="M13 8.5V6.5C13 6.23478 12.8946 5.98051 12.707 5.79297C12.5195 5.60543 12.2652 5.5 12 5.5H5C4.73478 5.5 4.4805 5.60543 4.29297 5.79297C4.10543 5.9805 4 6.23478 4 6.5V18.5C4 18.7652 4.10543 19.0195 4.29297 19.207C4.48051 19.3946 4.73478 19.5 5 19.5H12C12.2652 19.5 12.5195 19.3946 12.707 19.207C12.8946 19.0195 13 18.7652 13 18.5V16.5C13 15.9477 13.4477 15.5 14 15.5C14.5523 15.5 15 15.9477 15 16.5V18.5C15 19.2957 14.6837 20.0585 14.1211 20.6211C13.5585 21.1837 12.7957 21.5 12 21.5H5C4.20435 21.5 3.44152 21.1837 2.87891 20.6211C2.3163 20.0585 2 19.2956 2 18.5V6.5C2 5.70435 2.3163 4.94152 2.87891 4.37891C3.44152 3.8163 4.20435 3.5 5 3.5H12C12.7956 3.5 13.5585 3.8163 14.1211 4.37891C14.6837 4.94151 15 5.70435 15 6.5V8.5C15 9.05228 14.5523 9.5 14 9.5C13.4477 9.5 13 9.05228 13 8.5Z" fill="white" />
                            <path d="M17.293 8.79302C17.6835 8.40249 18.3165 8.40249 18.707 8.79302L21.707 11.793C21.993 12.079 22.0786 12.5092 21.9238 12.8829C21.769 13.2565 21.4044 13.5 21 13.5H9C8.44772 13.5 8 13.0523 8 12.5C8 11.9478 8.44772 11.5 9 11.5H18.5859L17.293 10.2071L17.2246 10.1309C16.9043 9.73813 16.9269 9.15913 17.293 8.79302Z" fill="white" />
                            <path d="M20.2929 11.793C20.6834 11.4025 21.3164 11.4025 21.707 11.793C22.0975 12.1835 22.0975 12.8166 21.707 13.2071L18.707 16.2071C18.3164 16.5976 17.6834 16.5976 17.2929 16.2071C16.9024 15.8166 16.9024 15.1835 17.2929 14.793L20.2929 11.793Z" fill="white" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="container text-white content mt-lg-3">
            <div class="row mission-row">
                <div class="col-12 col-lg-5 mission-container m-b-40-xs px-lg-0">
                    <h3 class="title">Missions</h3>
                    <div class="accordion-scroll">
                        <div class="accordion" id="accordionMissionExample">
                            @foreach($missions as $mission)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="mission-heading{{ $mission['id'] }}">
                                    <button class="accordion-button custom-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mission{{ $mission['id'] }}"
                                        aria-expanded="false"
                                        aria-controls="mission{{ $mission['id'] }}">
                                        <div class="d-flex justify-content-between w-100">
                                            <div class="mission-label">
                                                <p>{{ empty($mission['is_final']) ? 'Mission ' . sprintf('%02d', $mission['id']) : 'Final Mission' }}</p>
                                                <h3>{{ $mission['title'] }}</h3>
                                            </div>
                                            <div class="progress-sec">
                                                @if(empty($mission['is_final']))
                                                <p>Task Progress</p>
                                                <span class="progress-text" id="mission{{ $mission['id'] }}-progress">00/{{ sprintf('%02d', count($mission['tasks'])) }}</span>
                                                @else
                                                <p>Receipt Submitted</p>
                                                <span class="progress-text" id="receipt-submitted">00</span>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="mission{{ $mission['id'] }}" class="accordion-collapse collapse" aria-labelledby="mission-heading{{ $mission['id'] }}">
                                    <div class="accordion-body">
                                        @if(empty($mission['is_final']))
                                        @foreach($mission['tasks'] as $index => $task)
                                        <div class="task-card" id="task{{ $loop->iteration }}" data-mission="{{ $mission['id'] }}" data-api-key="{{ $task['api_key'] }}"
                                            data-step="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}" data-link="{{ $task['link'] }}">
                                            <p class="title font-adjust">{{ $task['label'] }}</p>
                                            <button class="btn-bold">
                                                <h6 class="btn-text status-text font-adjust">GO</h6>
                                                <img src="{{ asset('img/polygon.png') }}" class="btn-bg">
                                            </button>
                                        </div>
                                        @endforeach
                                        @if(isset($mission['note']))
                                        <p class="note">Note: {{ $mission['note'] }}</p>
                                        @endif
                                        @else
                                        <!-- Mission 4: File Upload -->
                                        <div class="submission" data-mission="{{ $mission['id'] }}">
                                            <p>Upload a receipt/proof of purchase* for Persona 3 Reload!</p>
                                            <div class="drag-n-drop" id="dropArea">
                                                <h6>Choose a file or drag & drop it here</h6>
                                                <p>JPEG, PNG or PDF formats, up to 50MB</p>
                                                <button class="btn-tertiary text-uppercase mt-4 mt-xl-5" id="browseBtn">Browse File</button>
                                                <input type="file" id="fileInput" hidden accept=".jpg,.jpeg,.png,.pdf" />
                                            </div>
                                            <div class="file-upload d-none" id="fileBox">
                                                <div class="d-flex gap-4 align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M12 2L12.117 2.007C12.3402 2.03332 12.5481 2.13408 12.707 2.29301C12.8659 2.45194 12.9667 2.65978 12.993 2.883L13 3V7L13.005 7.15C13.0408 7.62617 13.2458 8.07383 13.5829 8.41203C13.92 8.75023 14.3669 8.95666 14.843 8.994L15 9H19L19.117 9.007C19.3402 9.03332 19.5481 9.13408 19.707 9.29301C19.8659 9.45194 19.9667 9.65978 19.993 9.883L20 10V19C20 19.7652 19.7077 20.5015 19.1827 21.0583C18.6578 21.615 17.9399 21.9501 17.176 21.995L17 22H7C6.23479 22 5.49849 21.7077 4.94174 21.1827C4.38499 20.6578 4.04989 19.9399 4.005 19.176L4 19V5C3.99996 4.23479 4.29233 3.49849 4.81728 2.94174C5.34224 2.38499 6.06011 2.04989 6.824 2.005L7 2H12Z" fill="white" />
                                                        <path d="M19 7.00002H15L14.999 2.99902L19 7.00002Z" fill="white" />
                                                    </svg>
                                                    <div class="d-flex file-info">
                                                        <div class="file-details">
                                                            <p class="file-name">File name.jpg</p>
                                                            <p class="help-text file-size m-0">-</p>
                                                            <span class="upload-status text-cyan">Uploading...</span>
                                                        </div>
                                                        <button class="btn" id="deleteFileBtn">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path d="M4 7H20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M5 7L6 19C6 19.5304 6.21071 20.0391 6.58579 20.4142C6.96086 20.7893 7.46957 21 8 21H16C16.5304 21 17.0391 20.7893 17.4142 20.4142C17.7893 20.0391 18 19.5304 18 19L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M9 7V4C9 3.73478 9.10536 3.48043 9.29289 3.29289C9.48043 3.10536 9.73478 3 10 3H14C14.2652 3 14.5196 3.10536 14.7071 3.29289C14.8946 3.48043 15 3.73478 15 4V7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M10 12L14 16M14 12L10 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div id="progressBox" class="d-flex align-items-center gap-2 mt-2">
                                                    <div class="progress flex-grow-1 me-2">
                                                        <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span id="progressPercent" class="help-text text-white m-0">0%</span>
                                                </div>
                                            </div>
                                            <p class="help-text m-0">*Only the latest uploaded receipt is accepted. Verification of receipts will be done during the lucky draw period.</p>
                                        </div>
                                        @endif
                                        <div class="bonus-status bonus-locked" id="mission{{ $mission['id'] }}-status"
                                            data-id="{{ $mission['id'] }}"
                                            data-desc="{{ $mission['bonus']['description'] }}"
                                            data-image="{{ asset($mission['bonus']['image']) }}"
                                            data-downloads='@json($mission["bonus"]["downloads"])'>
                                            <img class="lock-icon" src="{{ asset('img/lock.png') }}">
                                            <span class="status-label font-adjust">Bonus Prize Locked</span>
                                        </div>
                                        <p class="help-text" id="mission{{ $mission['id'] }}-desc">
                                            Complete all {{ !empty($mission['tasks']) ? count($mission['tasks']) : 1 }} task(s) to unlock a bonus prize!
                                        </p>
                                    </div>
                                    @include('modals.bonus-prize', ['mission' => $mission])
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 lucky-draw-sec text-center">
                    <h3 class="title">Lucky Draw</h3>
                    <p id="luckyDrawText">Complete missions to accumulate entry chances!</p>
                    <p class="mb-0">Entries acquired: <span id="entriesCount">0</span>/<span id="entriesTotal">3</span></p>
                    <div class="img-tint locked" id="imgTint">
                        <img class="img-fluid" id="prizeImg" src="img/prize-locked.png">
                        <div class="img-overlay">
                            <h6 id="progressText">Complete a mission to unlock!</h6>
                        </div>
                    </div>
                    <h6 class="event-dt text-cyan">Event period: 31 October - 21 November 2025</h6>
                    <button id="luckyDrawBtn" class="btn-tertiary" disabled>
                        ENTER LUCKY DRAW
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.entry-submission')
@endsection

@section('scripts')
<script>
    async function handleUnauthorized(response) {
        if (response.status === 401) {
            await logout();
            return true;
        }
        return false;
    }

    const missions = {
        1: {
            total: 1,
            completed: 0
        },
        2: {
            total: 2,
            completed: 0
        },
        3: {
            total: 1,
            completed: 0
        },
        4: {
            total: 1,
            completed: 0
        }
    };

    async function updateProgress(missionKey, missionId) {
        try {
            const response = await fetch("/api/update-progress", {
                method: "POST",
                headers: {
                    "Accept": "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    mission: missionKey,
                    completed: true,
                }),
            });
            if (await handleUnauthorized(response)) return;

            const data = await response.json();
            if (data.success) {
                await checkProgress();
                updateEntriesDisplay();
            }
        } catch (error) {
            console.error("Login / Signup failed:", error);
        }
    }

    async function checkProgress() {
        try {
            const response = await fetch('/api/mission-progress', {
                method: "GET",
                headers: {
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            if (await handleUnauthorized(response)) return;
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }

            const data = await response.json();
            const missionsData = data.data?.missions || data.missions;
            const missionCompletion = {};

            if (!missionsData) return;

            Object.values(missions).forEach(m => m.completed = 0);
            for (const [key, obj] of Object.entries(missionsData)) {
                const card = document.querySelector(`[data-api-key="${key}"]`);
                if (!card) continue;

                const mission = card.dataset.mission;
                const statusText = card.querySelector(".status-text");

                if (!missionCompletion[mission]) missionCompletion[mission] = {
                    done: 0,
                    total: 0
                };
                missionCompletion[mission].total++;
                if (obj.completed) {
                    card.classList.add("complete");
                    card.style.pointerEvents = "none";
                    card.setAttribute("aria-disabled", "true");
                    if (statusText) statusText.textContent = "DONE";
                    missionCompletion[mission].done++;
                } else {
                    card.classList.remove("complete");
                    card.style.pointerEvents = "auto";
                    card.removeAttribute("aria-disabled");
                    if (statusText) statusText.textContent = "GO";
                }
            }
            for (const [missionId, counts] of Object.entries(missionCompletion)) {
                missions[missionId].completed = counts.done;

                const progressEl = document.getElementById(`mission${missionId}-progress`);
                if (progressEl) {
                    progressEl.textContent =
                        counts.done >= counts.total ?
                        "Completed" :
                        `${formatNumber(counts.done)}/${formatNumber(counts.total)}`;
                    progressEl.classList.toggle("completed", counts.done >= counts.total);
                }
                if (counts.done >= counts.total) {
                    completeMission(missionId);
                } else {
                    lockMissionUI(missionId, counts);
                }
            }

            // Special handling for Mission 4
            if (missionsData.m4 && missionsData.m4.completed) {
                completeMission(4);
                updateReceiptStatus(true);
            } else {
                incompleteMission(4, 0);
                updateReceiptStatus(false);
            }

            const luckyDraw = missionsData.lucky_draw;
            if (luckyDraw && luckyDraw.completed) {
                localStorage.setItem('luckyDrawCompleted', 'true');
                luckyDrawBtn.textContent = "Check Entries";
                luckyDrawBtn.classList.add('btn-check-entries');
            } else {
                localStorage.removeItem('luckyDrawCompleted');
                luckyDrawBtn.textContent = "Enter Lucky Draw";
                luckyDrawBtn.classList.remove('btn-check-entries');
            }

            updateLuckyDrawSection();
            updateEntriesDisplay();

        } catch (error) {
            console.error("check progress failed:", error);
        }
    }

    function lockMissionUI(missionId, counts) {
        const statusEl = document.getElementById(`mission${missionId}-status`);
        const descEl = document.getElementById(`mission${missionId}-desc`);
        const lockIcon = statusEl?.querySelector(".lock-icon");

        if (statusEl) {
            statusEl.classList.remove("bonus-unlocked");
            statusEl.classList.add("bonus-locked");
            const label = statusEl.querySelector(".status-label");
            if (label) label.textContent = "Bonus Prize Locked";
        }
        if (lockIcon) lockIcon.style.display = "inline-block";

        const done = counts?.done ?? missions[missionId].completed;
        const total = counts?.total ?? missions[missionId].total;
        if (descEl) descEl.textContent = `Complete all ${total} task(s) to unlock a bonus prize!`;
    }

    function completeMission(missionId) {
        if (!missions[missionId]) return;
        missions[missionId].completed = missions[missionId].total;

        const progressEl = document.getElementById(`mission${missionId}-progress`);
        if (progressEl) {
            progressEl.textContent = "Completed";
            progressEl.classList.add("completed");
        }

        const statusEl = document.getElementById(`mission${missionId}-status`);
        const descEl = document.getElementById(`mission${missionId}-desc`);
        const lockIcon = statusEl?.querySelector(".lock-icon");

        if (statusEl) {
            statusEl.classList.add("bonus-unlocked");
            statusEl.classList.remove("bonus-locked");
            const label = statusEl.querySelector(".status-label");
            if (label) label.textContent = "Bonus Prize Unlocked!";
        }
        if (lockIcon) lockIcon.style.display = "none";
        if (descEl) descEl.innerHTML = "You have completed your tasks! <br> Unlock and claim your bonus prize.";
        updateLuckyDrawSection();
    }

    function incompleteMission(missionId, doneCount = null) {
        if (!missions[missionId]) return;

        if (doneCount !== null) {
            missions[missionId].completed = doneCount !== null ? doneCount : 0;
        }

        const progressEl = document.getElementById(`mission${missionId}-progress`);
        const done = missions[missionId].completed;
        const total = missions[missionId].total;

        if (progressEl) {
            progressEl.textContent = `${formatNumber(done)}/${formatNumber(total)}`;
            progressEl.classList.remove("completed");
        }

        const statusEl = document.getElementById(`mission${missionId}-status`);
        const descEl = document.getElementById(`mission${missionId}-desc`);
        const lockIcon = statusEl?.querySelector(".lock-icon");

        if (statusEl) {
            statusEl.classList.remove("bonus-unlocked");
            statusEl.classList.add("bonus-locked");
            const label = statusEl.querySelector(".status-label");
            if (label) label.textContent = "Bonus Prize Locked";
        }
        if (lockIcon) lockIcon.style.display = "inline-block";
        if (descEl) descEl.textContent = `Complete all ${total} task(s) to unlock a bonus prize!`;
        updateLuckyDrawSection();
    }

    function updateLuckyDrawSection() {
        const completedMissions = Object.values(missions).filter(m => m.completed >= m.total).length;
        const allMissions = Object.keys(missions).length;

        const imgTint = document.getElementById('imgTint');
        const prizeImg = document.getElementById('prizeImg');
        const luckyDrawText = document.getElementById('luckyDrawText');
        const luckyDrawBtn = document.getElementById('luckyDrawBtn');
        const progressText = document.getElementById('progressText');
        const entriesCount = document.getElementById("entriesCount");

        if (!imgTint || !prizeImg || !luckyDrawBtn) return;

        if (completedMissions >= 1) {
            imgTint.classList.add("unlocked");
            imgTint.classList.remove("locked");
            prizeImg.src = 'img/prize.webp';
            luckyDrawBtn.disabled = false;
            luckyDrawBtn.classList.remove("disabled");
            if (progressText) progressText.textContent = "";
            if (completedMissions === allMissions) {
                luckyDrawText.textContent = "You've completed all mission(s)!";
            } else {
                luckyDrawText.textContent = "Complete missions to accumulate entry chances!";
            }
        } else {
            imgTint.classList.remove("unlocked");
            imgTint.classList.add("locked");
            prizeImg.src = 'img/prize-locked.png';
            luckyDrawBtn.disabled = true;
            luckyDrawBtn.classList.add("disabled");
            if (progressText) progressText.textContent = "Complete a mission to unlock!";
            luckyDrawText.textContent = "Complete missions to accumulate entry chances!";
        }
        if (entriesCount) {
            entriesCount.textContent = completedMissions;
        }
        localStorage.setItem('entriesCount', completedMissions);
    }

    function updateEntriesDisplay() {
        const totalMissions = 3;
        let completedMissions = 0;
        let hasReceipt = false;

        for (let [id, mission] of Object.entries(missions)) {
            if (parseInt(id) <= 3 && mission.completed >= mission.total) {
                completedMissions++;
            }
            if (parseInt(id) === 4 && mission.completed >= mission.total) {
                hasReceipt = true;
            }
        }

        const displayCount = hasReceipt ? completedMissions + 1 : completedMissions;
        const entriesCount = document.getElementById('entriesCount');
        const entriesTotal = document.getElementById('entriesTotal');

        if (entriesCount) entriesCount.textContent = displayCount;
        if (entriesTotal) entriesTotal.textContent = totalMissions;
        localStorage.setItem('entriesCompleted', displayCount);
        localStorage.setItem('entriesTotal', totalMissions);
    }

    document.querySelectorAll(".task-card").forEach(card => {
        const link = card.dataset.link || null;
        const missionKey = card.dataset.apiKey;
        const missionId = card.dataset.mission;
        const btn = card.querySelector(".btn-bold");
        const statusText = card.querySelector(".status-text");

        const handleClick = (e) => {
            e.stopPropagation();
            if (card.classList.contains("complete")) return;

            if (link) {
                window.open(link, "_blank", "noopener,noreferrer");
            }
            setTimeout(async () => {
                try {
                    await updateProgress(missionKey, missionId);
                } catch (err) {
                    console.error("updateProgress error:", err);
                    if (statusText) statusText.textContent = "GO";
                    if (btn) btn.disabled = false;
                }
            }, 5000);
        };

        card.addEventListener("click", handleClick);
        if (btn) btn.addEventListener("click", handleClick);
    });

    function onReceiptUploaded() {
        completeMission(4);
        updateEntriesDisplay();
    }

    function updateReceiptStatus(isUploaded) {
        const receiptEl = document.getElementById('receipt-submitted');
        if (!receiptEl) return;

        if (isUploaded) {
            receiptEl.textContent = "01";
            receiptEl.classList.add("completed");
        } else {
            receiptEl.textContent = "00";
            receiptEl.classList.remove("completed");
        }
    }

    function uploadFile(file) {
        const fileNameEl = document.querySelector(".file-name");
        const fileSizeEl = document.querySelector(".file-size");
        const uploadStatus = document.querySelector(".upload-status");
        const progressBar = document.getElementById("progressBar");
        const progressPercent = document.getElementById("progressPercent");
        const progressBox = document.querySelector(".progress");
        const deleteBtn = document.getElementById("deleteFileBtn");
        const browseBtn = document.getElementById("browseBtn");

        if (fileNameEl) fileNameEl.textContent = file.name;
        if (fileSizeEl) fileSizeEl.textContent = "-";
        uploadStatus.textContent = "Uploading...";
        uploadStatus.classList.remove("text-success", "text-danger", "d-none");
        uploadStatus.classList.add("text-cyan");

        progressBox.classList.remove("d-none");
        progressBar.style.width = "0%";
        progressPercent.textContent = "0%";
        progressPercent.classList.remove("d-none");

        deleteBtn.disabled = true;
        browseBtn.disabled = true;

        const formData = new FormData();
        formData.append("image", file);

        try {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "/api/upload-image", true);
            xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').content);

            xhr.upload.onprogress = (event) => {
                if (event.lengthComputable) {
                    const percent = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = `${percent}%`;
                    progressPercent.textContent = `${percent}%`;
                }
            };

            xhr.onload = function() {
                const status = xhr.status;
                let data = {};
                try {
                    data = JSON.parse(xhr.responseText);
                } catch {}

                deleteBtn.disabled = false;
                browseBtn.disabled = false;

                if (xhr.status === 401) {
                    alert("Session expired. Please log in again.");
                    localStorage.clear();
                    window.location.href = "/";
                    return;
                }

                if (status >= 200 && status < 300) {
                    const receiptData = {
                        filename: data.data.filename,
                        box_url: data.data.box_url,
                        file_size: formatFileSize(file.size),
                    };
                    localStorage.setItem('receipt', JSON.stringify(receiptData));

                    uploadStatus.textContent = "Complete";
                    uploadStatus.className = "upload-status text-success";
                    fileSizeEl.textContent = formatFileSize(file.size);

                    progressBox.style.transition = "opacity 0.4s ease";
                    uploadStatus.style.transition = "opacity 0.4s ease";
                    progressPercent.style.transition = "opacity 0.4s ease";

                    progressBox.style.opacity = "1";
                    uploadStatus.style.opacity = "1";
                    progressPercent.style.opacity = "1";

                    setTimeout(() => {
                        progressBox.style.opacity = "0";
                        uploadStatus.style.opacity = "0";
                        progressPercent.style.opacity = "0";
                    }, 800);

                    setTimeout(() => {
                        progressBox.classList.add("d-none");
                        uploadStatus.classList.add("d-none");
                        progressPercent.classList.add("d-none");
                    }, 1300);

                    onReceiptUploaded();
                    updateReceiptStatus(true);
                } else {
                    handleUploadError(file, uploadStatus, progressBar, fileSizeEl, "Upload failed");
                }
            };

            xhr.onerror = function() {
                progressBox.classList.add("d-none");
                progressPercent.classList.add("d-none");
                deleteBtn.disabled = false;
                browseBtn.disabled = false;

                handleUploadError(file, uploadStatus, progressBar, fileSizeEl, "Connection lost");
            };

            xhr.send(formData);
        } catch (error) {
            progressBox.classList.add("d-none");
            progressPercent.classList.add("d-none");
            deleteBtn.disabled = false;
            browseBtn.disabled = false;

            handleUploadError(file, uploadStatus, progressBar, fileSizeEl, "Upload failed");
        }
    }

    function handleUploadError(file, uploadStatus, progressBar, fileSizeEl, message) {
        uploadStatus.textContent = message;
        uploadStatus.className = "upload-status text-danger";
        fileSizeEl.textContent = formatFileSize(file.size);
    }

    function formatFileSize(bytes) {
        const kb = bytes / 1024;
        return kb > 1024 ? (kb / 1024).toFixed(2) + " MB" : kb.toFixed(1) + " KB";
    }

    function formatNumber(num) {
        return String(num).padStart(2, "0");
    }

    document.addEventListener("DOMContentLoaded", function() {
        checkProgress();

        // Sign Out //
        document.getElementById('signoutBtn').addEventListener('click', function(e) {
            e.preventDefault();
            const signoutModal = new bootstrap.Modal(document.getElementById("signoutModal"), {
                backdrop: false,
                keyboard: false
            });
            signoutModal.show();
        });

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
        if (imgTint) {
            imgTint.addEventListener('click', () => {
                if (imgTint.classList.contains('locked')) {
                    const unlockModal = new bootstrap.Modal(document.getElementById("errorUnlockModal"), {
                        backdrop: false,
                        keyboard: false
                    });
                    unlockModal.show();
                }
            });
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

            fileName.textContent = file.name;
            fileSize.textContent = `${Math.round(file.size / 1024)} kb`;

            uploadFile(file);
        }

        function validateFile(file) {
            const validTypes = ["image/jpeg", "image/png", "application/pdf"];
            if (!validTypes.includes(file.type)) {
                alert(`${file.name} is not a valid file type.`);
                return false;
            }
            return true;
        }

        deleteFileBtn.addEventListener("click", () => {
            fileBox.classList.add("d-none");
            dropArea.classList.remove("d-none");
            fileInput.value = "";
            progressBar.style.width = "0%";
            progressPercent.textContent = "0%";

            updateReceiptStatus(false);
            missions[4].completed = 0;
            incompleteMission(4, 0);
            updateEntriesDisplay();
        });

        const luckyDrawBtn = document.getElementById('luckyDrawBtn');
        const entryModalEl = document.getElementById('entryModal');
        const entryBtn = document.getElementById('entryBtn');
        const backBtn = document.getElementById('backBtn');
        const modalInstance = new bootstrap.Modal(entryModalEl);
        const emText = document.getElementById('emText');

        let hasSubmitted = localStorage.getItem('luckyDrawCompleted') === 'true';

        luckyDrawBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const step1 = entryModalEl.querySelector('.step-1');
            const step2 = entryModalEl.querySelector('.step-2');
            const completed = Number(localStorage.getItem('entriesCompleted') || 0);
            const total = Number(localStorage.getItem('entriesTotal') || 3);
            const capped = Math.min(completed, 3);
            const hasSubmitted = localStorage.getItem('luckyDrawCompleted') === 'true';

            step1.classList.remove('d-none');
            step2.classList.add('d-none');

            if (hasSubmitted) {
                entryBtn.disabled = true;
                entryBtn.textContent = "Entries Submitted";
                backBtn.classList.remove('d-none');
                emText.textContent = `You have submitted accumulated entries of [${capped}] for the draw.`;
            } else {
                entryBtn.disabled = false;
                entryBtn.textContent = `Submit Entries (${completed}/${total})`;
                backBtn.classList.add('d-none');
                emText.textContent = `You have completed [${completed}] mission(s), and have accumulated entries of [${capped}] for the draw.`;
            }

            modalInstance.show();
        });
        entryBtn.addEventListener('click', async () => {
            if (entryBtn.disabled) return;

            try {
                const token = localStorage.getItem('api_token');
                if (!token) return await logout();

                entryBtn.disabled = true;
                entryBtn.textContent = "Submitting...";

                const response = await fetch('/api/update-progress', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Api-Token': token,
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        mission: 'is_lucky_draw',
                        completed: true
                    })
                });

                if (await handleUnauthorized(response)) return;

                const res = await response.json();
                if (!response.ok || !res.success) throw new Error(res.message || 'Failed to submit lucky draw.');

                localStorage.setItem('luckyDrawCompleted', 'true');

                entryModalEl.querySelector('.step-1').classList.add('d-none');
                entryModalEl.querySelector('.step-2').classList.remove('d-none');

                luckyDrawBtn.textContent = "Check Entries";
                luckyDrawBtn.classList.add('btn-check-entries');
            } catch (err) {
                console.error(err);
                entryBtn.disabled = false;
                entryBtn.textContent = "Submit Entries";
            }
        });
        entryModalEl.addEventListener('hidden.bs.modal', () => {
            if (hasSubmitted) {
                luckyDrawBtn.textContent = "Check Entries";
                luckyDrawBtn.classList.add('btn-check-entries');
            }
        });
    });
</script>
@endsection