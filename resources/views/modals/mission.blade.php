<div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-image-modal">
            <div class="modal-header text-white">
                <div class="d-flex justify-content-between w-100">
                    <!-- <button class="btn-back" data-bs-dismiss="modal"><img src="img/back.png">Back</button> -->
                    <img class="p3-logo cursor-pointer" src="img/p3.png" data-bs-dismiss="modal">
                    <div class="d-flex items-center">
                        <div class="user-details">
                            <h6>John123</h6>
                            <p>john123@email.com</p>
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
            <div class="modal-body text-white">
                <div class="row mission-row">
                    <div class="col-12 col-lg-6 mission-container order-lg-1 m-b-40-xs">
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
                                                    <p>Mission {{ sprintf('%02d', $mission['id']) }}</p>
                                                    <h3>{{ $mission['title'] }}</h3>
                                                </div>
                                                <div class="progress-sec">
                                                    <p>Task Progress</p>
                                                    <span class="progress-text" id="mission{{ $mission['id'] }}-progress">00/{{ sprintf('%02d', count($mission['tasks'])) }}</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="mission{{ $mission['id'] }}" class="accordion-collapse collapse" aria-labelledby="mission-heading{{ $mission['id'] }}">
                                        <div class="accordion-body">
                                            @foreach($mission['tasks'] as $index => $task)
                                            <div class="task-card" id="task{{ $loop->iteration }}" data-mission="{{ $mission['id'] }}" data-step="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}">
                                                <p class="title font-adjust">{{ $task }}</p>
                                                <button class="btn-bold">
                                                    <h6 class="btn-text status-text font-adjust">GO</h6>
                                                    <img src="{{ asset('img/polygon.png') }}" class="btn-bg">
                                                </button>
                                            </div>
                                            @endforeach

                                            @if(isset($mission['note']))
                                            <em>Note: {{ $mission['note'] }}</em>
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
                                                Complete all {{ count($mission['tasks']) }} task(s) to unlock a bonus prize!
                                            </p>
                                        </div>
                                        @include('modals.bonus-prize', ['mission' => $mission])
                                    </div>
                                </div>
                                @endforeach

                                <!-- <div class="accordion-item">
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
                                                <h6 class="status-text font-adjust">GO</h6>
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
                                </div> -->

                                <!-- <div class="accordion-item">
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
                                </div> -->

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
                                                <p class="help-text">*Only the latest uploaded receipt is accepted. Verification of receipts will be done during the lucky draw period.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 prize-section text-center order-lg-2">
                        <h3 class="title">Lucky Draw</h3>
                        <p id="luckyDrawText">Complete missions to accumulate entry chances!</p>
                        <p>Entries acquired: 0</p>

                        <!-- <div class="d-flex justify-content-center">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                <span id="progressPercent" class="progress-label">0%</span>
                            </div>
                        </div> -->
                        <div class="img-tint" id="imgTint">
                            <img id="prizeImg" src="img/prize-v2.png">
                            <div class="img-overlay">
                                <h6 id="progressText">Complete a mission to unlock!</p>
                            </div>
                        </div>
                        <h6 class="event-dt text-cyan">Event period: xx October - xx November 2025</h6>
                        <button id="luckyDrawBtn" class="btn-tertiary text-uppercase">
                            Enter Lucky Draw
                        </button>
                        <!-- <button id="luckyDrawBtn" class="btn-bold w-100">
                            <span class="btn-text">Enter Lucky Draw</span>
                            <img src="img/polygon-long.png" class="btn-bg">
                        </button> -->
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</div>