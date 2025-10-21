<div class="auth-modal modal fade" id="signupModal" data-page="signup" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>
                    You've received a mysterious contract... <br>
                    Your fate rests on this document.
                </h3>
                <h5>Enter your username and email to join the missions.</h5>
                <form action="">
                    <div class="form-group">
                        <div>
                            <label for="signupUsername">Username</label>
                            <input type="text" id="signupUsername" placeholder="Your Username" class="form-control" autocomplete="off" required>
                            <hr class="gradient-hr mb-24">
                        </div>
                        <div>
                            <label for="signupEmail">Email</label>
                            <input type="email" id="signupEmail" placeholder="example@email.com" class="form-control" autocomplete="off" required>
                            <hr class="gradient-hr mb-5">
                            <span id="signupEmailErr">Please enter a valid email.</span>
                        </div>
                        <div class="info">
                            <em>*Note down the exact username and email used here to retrieve your mission progress in the future.</em>
                            <p id="signupInputErr">Please enter both nick name and email to proceed.</p>
                            <p id="signupCheckboxErr">Please read and check the Terms of Service and Privacy Policy to proceed.</p>
                        </div>
                    </div>
                    <div class="form-check">
                        <input class="cursor-pointer form-check-input" type="checkbox" id="signupCheckbox" required>
                        <label class="cursor-pointer form-check-label" for="signupCheckbox">Yes, I acknowledge that I have read, understood, and agreed to the <a class="text-cyan text-underline">Terms of Service</a> and that I have read and understood the <a class="text-cyan text-underline">Privacy Policy</a>.</label>
                    </div>
                </form>
                <button id="signupNextBtn" class="w-100 btn-bold mt-lg-5" data-bs-toggle="modal" data-bs-target="#missionModal" disabled>
                    <span class="btn-text">Next</span>
                    <img src="img/polygon.png" class="btn-bg">
                </button>
            </div>
        </div>
    </div>
</div>