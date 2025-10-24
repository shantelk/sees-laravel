<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>P3R S.E.E.S Missions</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="preload" as="image" href="{{ asset('img/mission-bg.png') }}">
</head>

<body>
    <audio id="home-audio" loop>
        <source src="{{ asset('audio/music.mp3') }}" type="audio/mp3">
    </audio>
    <main>
        <div id="overlay" style="display: none;"></div>
        <div id="toaster" style="display: none;">
            <span>This website uses cookies to enhance your browsing experience.
                <a href="#">Learn more</a>
            </span>
            <button id="toasterBtn" class="btn-bold">
                <span class="btn-text">Ok</span>
                <img src="img/polygon.png" class="btn-bg">
            </button>
        </div>
        <div class="switch-container">
            <button id="home-audio-toggle" class="btn-audio">
                <span class="audio-text">Mute</span>
                <div class="icon-wrapper">
                    <img class="audio-icon volume active" src="img/volume.png" alt="Volume">
                    <img class="audio-icon mute" src="img/volume-mute.png" alt="Mute">
                </div>
            </button>
        </div>

        @yield('content')
    </main>

    @include('partials.footer')

    @include('modals.auth.login')
    @include('modals.auth.signup')

    @include('modals.static-content', [ 'id'=> 'tosModal', 'title'=> 'P3R S.E.E.S. Missions” Campaign Terms and Conditions'])

    @include('modals.confirmation', [
        'id' => 'signoutModal',
        'title' => 'Are you sure <br> you want to logout?',
        'buttonText' => 'No, bring me back',
    ])
    @include('modals.confirmation', [
        'id' => 'errorUnlockModal',
        'title' => 'Complete at least 1 <br> mission to join.',
        'buttonText' => 'Back to Missions',
    ])

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
    @yield('scripts')
</body>

</html>