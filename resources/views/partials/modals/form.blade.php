<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn-close btn-close-white opacity-100" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>You receive a mysterious contract... <br>
                    Seems like your fate rests on this document.</h3>
                <form action="">
                    <div class="form-group">
                        <label for="emailInput">Enter your email to continue.</label>
                        <input type="email" id="emailInput" placeholder="example123@email.com" class="form-control input-gradient" required>
                        <hr class="gradient-hr">
                        <span>Please enter a valid email.</span>
                    </div>
                    <div class="form-check">
                        <input class="cursor-pointer form-check-input" type="checkbox" id="inlineCheckbox" required>
                        <label class="cursor-pointer form-check-label" for="inlineCheckbox">Yes, I acknowledge that I have read, understood, and agreed to the <a>Terms of Service</a> and that I have read and understood the <a>Privacy Policy</a>.</label>
                    </div>
                </form>
                <button id="nextBtn" class="w-100 btn-bold" data-bs-toggle="modal" data-bs-target="#missionModal" disabled>
                    <span class="btn-text">Next</span>
                    <img src="img/polygon.png" class="btn-bg">
                </button>
            </div>
        </div>
    </div>
</div>