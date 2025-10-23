<div class="modal dark-overlay nested-modal" id="{{ $id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-bg-dark text-center">
            <button type="button" class="btn text-end px-0" data-bs-dismiss="modal" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M17.293 5.29295C17.6835 4.90243 18.3165 4.90243 18.707 5.29295C19.0976 5.68348 19.0976 6.31649 18.707 6.70702L13.4141 12L18.707 17.293L18.7754 17.3691C19.0957 17.7619 19.0731 18.3409 18.707 18.707C18.3409 19.0731 17.7619 19.0957 17.3691 18.7754L17.293 18.707L12 13.414L6.70703 18.707C6.31651 19.0975 5.68349 19.0975 5.29297 18.707C4.90244 18.3165 4.90244 17.6835 5.29297 17.293L10.5859 12L5.29297 6.70702C4.90244 6.31649 4.90244 5.68348 5.29297 5.29295C5.68349 4.90243 6.31651 4.90243 6.70703 5.29295L12 10.5859L17.293 5.29295Z" />
                </svg>
            </button>
            <div class="modal-body pt-0">
                <h3>{!! $title !!}</h3>
                <div class="w-100">
                    <button class="btn-tertiary mt-4" data-bs-dismiss="modal" aria-label="Close">{{ $buttonText }}</button>
                </div>
                @if($id == 'signoutModal')
                <div>
                    <button class="btn-link" onclick="logout()">Yes, log me out</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function logout() {
        fetch("{{ route('logout') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    sessionStorage.clear();
                    window.location.href = "/";
                }
            })
            .catch(err => console.error('Logout failed:', err));
    }
</script>