<div class="auth-modal modal fade" id="loginModal" data-page="login" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="d-flex justify-content-end px-md-4">
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>
                    Welcome back...
                </h3>
                <h5>Enter your username and email to continue the missions</h5>
                <form id="loginForm">
                    @csrf
                    <div class="form-group">
                        <div>
                            <label for="loginUsername">Username</label>
                            <input type="text" id="loginUsername" placeholder="Your Username" class="form-control" autocomplete="off" required>
                            <hr class="gradient-hr mb-24">
                        </div>
                        <div>
                            <label for="loginEmail">Email</label>
                            <input type="email" id="loginEmail" placeholder="example@email.com" class="form-control" autocomplete="off" required>
                            <hr class="gradient-hr mb-5">
                        </div>
                        <div class="info">
                            <p id="loginErr">Please enter correct username and email to proceed.</p>
                        </div>
                    </div>
                </form>
                <button type="submit" id="loginNextBtn" class="w-100 btn-bold mt-md-5" onclick="submitAuth('login')" disabled>
                    <span class="btn-text">Next</span>
                    <img src="img/polygon.png" class="btn-bg">
                </button>
                <button class="btn-link mt-3" data-bs-toggle="modal" data-bs-target="#signupModal">No account? Sign up</button>
            </div>
        </div>
    </div>
</div>

@include('modals.error')