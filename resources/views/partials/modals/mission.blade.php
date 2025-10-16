<div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-image-modal">
            <div class="modal-header text-white">
                <div class="d-flex justify-content-between w-100">
                    <button class="btn-back" data-bs-dismiss="modal"><img src="img/back.png">Back</button>
                    <img class="p3-logo cursor-pointer" src="img/p3.png" data-bs-dismiss="modal">
                </div>
            </div>
            <div class="modal-body text-white">
                <div class="row mission-row">
                    <div class="col-12 col-lg-6 mission-container order-lg-1 m-b-40-xs">
                        <h3 class="title">Missions</h3>
                        <div class="accordion-scroll">
                            <div class="accordion" id="accordionMissionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="mission-heading1">
                                        <button class="accordion-button custom-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mission1" aria-expanded="false" aria-controls="mission1">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="mission-label">
                                                    <p>Mission 01</p>
                                                    <h3>Contract</h3>
                                                </div>
                                                <div class="progress-sec">
                                                    <p>Task Progress</p>
                                                    <span class="progress-text" id="mission1-progress">00/01</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="mission1" class="accordion-collapse collapse" aria-labelledby="mission-heading1">
                                        <div class="accordion-body">
                                            <div class="task-card" id="task1" data-mission="1" data-step="01">
                                                <p class="title font-adjust">Login or signup for a SEGA Account</p>
                                                <button id="nextBtn" class="btn-bold">
                                                    <h6 class="btn-text status-text font-adjust">GO</h6>
                                                    <img src="img/polygon.png" class="btn-bg">
                                                </button>
                                            </div>
                                            <div class="bonus-status bonus-locked" id="mission1-status">
                                                <img class="lock-icon" src="img/lock.png">
                                                <span class="status-label font-adjust">Bonus Prize Locked</span>
                                            </div>
                                            <p class="help-text" id="mission1-desc">Complete all 1 task(s) to unlock a bonus prize!</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="mission-heading2">
                                        <button class="accordion-button custom-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mission2" aria-expanded="false" aria-controls="mission2">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="mission-label">
                                                    <p>Mission 02</p>
                                                    <h3>Drive</h3>
                                                </div>
                                                <div class="progress-sec">
                                                    <p>Task Progress</p>
                                                    <span class="progress-text" id="mission2-progress">00/02</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="mission2" class="accordion-collapse collapse" aria-labelledby="mission-heading2">
                                        <div class="accordion-body">
                                            <div class="task-card" id="task2" data-mission="2" data-step="01">
                                                <p class="title font-adjust">Like / Follow ATLUS SEA on Facebook</p>
                                                <button id="nextBtn" class="btn-bold">
                                                    <h6 class="btn-text status-text font-adjust">GO</h6>
                                                    <img src="img/polygon.png" class="btn-bg">
                                                </button>
                                                <!-- <h6 class="status-text font-adjust">GO</h6> -->
                                            </div>
                                            <div class="task-card" id="task3" data-mission="2" data-step="02">
                                                <p class="title font-adjust">Follow @atlus.sea on Instagram</p>
                                                <button id="nextBtn" class="btn-bold">
                                                    <h6 class="btn-text status-text font-adjust">GO</h6>
                                                    <img src="img/polygon.png" class="btn-bg">
                                                </button>
                                            </div>
                                            <div class="bonus-status bonus-locked" id="mission2-status">
                                                <img class="lock-icon" src="img/lock.png">
                                                <span class="status-label font-adjust">Bonus Prize Locked</span>
                                            </div>
                                            <p class="help-text" id="mission2-desc">Complete all 2 task(s) to unlock a bonus prize!</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="mission-heading3">
                                        <button class="accordion-button custom-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mission3" aria-expanded="false" aria-controls="mission3">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="mission-label">
                                                    <p>Mission 03</p>
                                                    <h3>Unity</h3>
                                                </div>
                                                <div class="progress-sec">
                                                    <p>Task Progress</p>
                                                    <span class="progress-text" id="mission3-progress">00/01</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="mission3" class="accordion-collapse collapse" aria-labelledby="mission-heading3">
                                        <div class="accordion-body">
                                            <div class="task-card" id="task4" data-mission="3" data-step="01">
                                                <p class="title font-adjust">Join the ATLUS SEA Discord</p>
                                                <button id="nextBtn" class="btn-bold">
                                                    <h6 class="btn-text status-text font-adjust">GO</h6>
                                                    <img src="img/polygon.png" class="btn-bg">
                                                </button>
                                            </div>
                                            <div class="bonus-status bonus-lock" id="mission3-status">
                                                <img class="lock-icon" src="img/lock.png">
                                                <span class="status-label font-adjust">Bonus Prize Locked</span>
                                            </div>
                                            <p class="help-text" id="mission3-desc">Complete all 1 task(s) to unlock a bonus prize!</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item locked" id="final-mission">
                                    <h2 class="accordion-header" id="mission-heading4">
                                        <button disabled class="accordion-button collapsed custom-header" type="button" data-bs-toggle="collapse" data-bs-target="#mission-collapse4" aria-expanded="false" aria-controls="mission-collapse4">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="mission-label">
                                                    <p>Final Mission</p>
                                                    <h3>Dedication</h3>
                                                </div>
                                                <span id="final-countdown" class="countdown-badge"></span>
                                                <div class="progress-sec">
                                                    <p>Receipt Submitted</p>
                                                    <span class="progress-text" id="receipt-submitted">00</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="mission-collapse4" class="accordion-collapse collapse" aria-labelledby="mission-heading4">
                                        <div class="accordion-body">
                                            <div class="submission">
                                                <p>Upload a receipt/proof of purchase* for Persona 3 Reload!</p>
                                                <div class="file-upload" id="dropArea">
                                                    <h6>Choose a file or drag & drop it here</h6>
                                                    <p>JPEG, PNG or PDF formats, up to 50MB</p>
                                                    <button class="btn-tertiary text-uppercase mt-4 mt-lg-5" id="browseBtn">Browse File</button>
                                                    <input type="file" id="fileInput" hidden accept=".jpg,.jpeg,.png,.pdf" />
                                                    <ul id="fileList"></ul>
                                                </div>
                                                <p class="help-text">*Verification of receipts will be done during the lucky draw period.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 prize-section text-center order-lg-2">
                        <h3 class="title">Lucky Draw</h3>
                        <p id="luckyDrawText">Complete all tasks to unlock Lucky Draw!</p>

                        <div class="d-flex justify-content-center">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                <span id="progressPercent" class="progress-label">0%</span>
                            </div>
                        </div>
                        <div class="img-tint" id="imgTint">
                            <img id="prizeImg" src="img/prize-locked.png">
                            <div class="img-overlay">
                                <h6 id="progressText">Complete 04 tasks to unlock!</p>
                            </div>
                        </div>
                        <button id="luckyDrawBtn" class="btn-bold w-100">
                            <span class="btn-text">Enter Lucky Draw</span>
                            <img src="img/polygon-long.png" class="btn-bg">
                        </button>
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</div>