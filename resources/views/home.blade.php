<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P3R S.E.E.S Missions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>
    <div class="switch-container">
        <button id="home-audio-toggle" class="btn-audio">
            <span class="audio-text">Mute</span>
            <div class="icon-wrapper">
                <img class="audio-icon volume active" src="img/volume.png" alt="Volume">
                <img class="audio-icon mute" src="img/volume-mute.png" alt="Mute">
            </div>
        </button>
    </div>
    <!--<div id="overlay"></div>
     <div id="toaster">
        <span>This website uses cookies to enhance your browsing experience.
            <a href="#">Learn more</a>
        </span>
        <button id="toasterBtn" class="btn-bold">
            <span class="btn-text">Ok</span>
            <img src="img/polygon.png" class="btn-bg">
        </button>
    </div> -->
    <audio id="home-audio" autoplay loop muted>
        <source src="audio/music.mp3" type="audio/mp3">
    </audio>
    <div class="first-section">
        <img class="switch" src="img/switch.png">
        <div class="start-now-section">
            <button class="w-100 btn-bold" data-bs-toggle="modal" data-bs-target="#missionModal">
                <span>Launch</span>
            </button>

            <img src="img/p3.png">
            <h3>S.E.E.S. MISSIONS</h3>
            <p>SOUTHEAST ASIA EDITION</p>
            <div class="image-mask-container">
                <div onclick="scrollToBottom()" id="lottie-container" class="img img1 cursor-pointer"></div>
            </div>
        </div>
        <div class="img-container">
            <img src="img/character.png">
        </div>
    </div>
    <div class="second-section">
        <img src="img/band.png" class="img-band">
        <div class="background-box">
            <img src="img/background-box.png" class="background-box-img">
            <div class="row introduction">
                <div class="col-md-12 title">
                    <h3>JOIN THE S.E.E.S. MISSIONS!</h3>
                </div>
                <div class="col-12 col-lg-6 text-center order-2 order-lg-1">
                    <div class=" text-content">
                        <h3>Win Amazing Prizes</h3>
                        <h6 class="event-dt text-cyan">Event period: xx October - xx November 2025</h6>
                        <p>Participate in this Southeast Asia exclusive launch campaign for Persona 3 Reload on the Nintendo Switch 2! <br><br>
                            Join missions, work together on milestones and unlock a lucky draw for everyone. There’s a freebie in every mission, so everyone is a winner.</p>
                        </p>
                    </div>
                    <div class="btn-wrap btn-mission" id="btnMissions">
                        <span class="btn-bg"></span>
                        <button id="missionBtn" class="btn-text" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</button>
                    </div>
                    <button class="btn-link mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Already signed up? Continue missions here
                    </button>
                </div>
                <div class="col-12 col-lg-6 img-content p-0 order-1 order-lg-2">
                    <img src="img/prize-v2.png">
                    <p>*Prizes subject to change</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')

    @include('modals.mission', ['missions' => $missions])

    @include('modals.auth.login')
    @include('modals.auth.signup')

    @include('modals.static-content', [ 'id'=> 'ppModal', 'title'=> 'Privacy Policy'])
    @include('modals.static-content', [ 'id'=> 'tosModal', 'title'=> 'Terms of Service'])

    @include('modals.confirmation', [
        'id' => 'signoutModal',
        'title' => 'Are you sure <br> you want to logout?',
        'buttonText' => 'No, bring me back',
    ])
    @include('modals.confirmation', [
        'id' => 'errorUnlockModal',
        'title' => 'Complete at least 1 mission to join.',
        'buttonText' => 'Back to Missions',
    ])

    @include('modals.entry-submission')

    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('lottie-container'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'img/start-button.json'
        });
    </script>
</body>

</html>