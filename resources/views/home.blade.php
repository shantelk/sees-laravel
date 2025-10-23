@extends('layouts.app')
<!-- @php dump(session()->all()); @endphp -->
@section('content')
<!-- <div id="overlay"></div>
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

        <!-- <div>
            <button class="btn-link" onclick="logout()">Yes, log me out</button>
        </div> -->
        <!-- <a href="/missions" class="w-100 btn-bold">Launch</a> -->


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
                <div class="w-100">
                    <button class="btn-link mt-3" id="continueMissionBtn">
                        Already signed up? Continue missions here
                    </button>
                </div>
            </div>
            <div class="col-12 col-lg-6 img-content p-0 order-1 order-lg-2">
                <img src="img/prize.png">
                <p>*Prizes subject to change</p>
            </div>
        </div>
    </div>
</div>
@endsection


@php
$isLoggedIn = session()->has('api_token');
@endphp

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const continueBtn = document.getElementById('continueMissionBtn');
        if (!continueBtn) return;

        // pass the Blade value into JS safely
        const isLoggedIn = "{{ $isLoggedIn ? 'true' : 'false' }}" === 'true';
        console.log(isLoggedIn)
        if (continueBtn) {
            continueBtn.addEventListener('click', e => {
                e.preventDefault();
                if (isLoggedIn) {
                    console.log('here')
                    window.location.href = "/missions";
                } else {
                    const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
                    loginModal.show();
                    console.log('lol')

                }
            });
        }
    });
</script>