<div class="modal fade" id="missionModal" tabindex="-1" aria-labelledby="missionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-image-modal">
            <div class="modal-header text-white">
                <div class="d-flex justify-content-between w-100">
                    <img class="p3-logo cursor-pointer" src="img/p3.png" data-bs-dismiss="modal">
                    <div class="d-flex items-center gap-2">
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
                                            @php
                                                $link = $mission['links'][$index] ?? '#';
                                            @endphp
                                            <div class="task-card" id="task{{ $loop->iteration }}" data-mission="{{ $mission['id'] }}" data-step="{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}" onclick="window.open('{{ $link }}', '_blank', 'noopener')">
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
                                            @else
                                            <div class="submission" data-mission="{{ $mission['id'] }}">
                                                <p>Upload a receipt/proof of purchase* for Persona 3 Reload!</p>
                                                <div class="drag-n-drop" id="dropArea">
                                                    <h6>Choose a file or drag & drop it here</h6>
                                                    <p>JPEG, PNG or PDF formats, up to 50MB</p>
                                                    <button class="btn-tertiary text-uppercase mt-4 mt-lg-5" id="browseBtn">Browse File</button>
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
                                                    <div class="d-flex align-items-center gap-2 mt-2">
                                                        <div class="progress flex-grow-1 me-2">
                                                            <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <div class="col-12 col-lg-6 lucky-draw-sec text-center order-lg-2">
                        <h3 class="title">Lucky Draw</h3>
                        <p id="luckyDrawText">Complete missions to accumulate entry chances!</p>
                        <p>Entries acquired: 0</p>
                        <div class="img-tint" id="imgTint">
                            <img id="prizeImg" src="img/prize-v2-locked.png">
                            <div class="img-overlay">
                                <h6 id="progressText">Complete a mission to unlock!</h6>
                            </div>
                        </div>
                        <h6 class="event-dt text-cyan">Event period: xx October - xx November 2025</h6>
                        <button id="luckyDrawBtn" class="btn-tertiary" disabled>
                            ENTER LUCKY DRAW
                        </button>
                    </div>
                </div>
            </div>
            @include('partials.footer')
        </div>
    </div>
</div>