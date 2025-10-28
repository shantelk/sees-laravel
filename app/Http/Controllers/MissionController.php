<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function getMissions()
    {
        $missions = [
            [
                'id' => 1,
                'title' => 'Contract',
                'tasks' => [
                    ['api_key' => 'm1', 'label' => 'Login or signup for a SEGA Account', 'link' => 'https://sega-account.com/'],
                ],
                'note' => 'Please use the same email as this campaign to qualify for a valid entry.',
                'bonus' => [
                    'description' => "Here's an exclusive Persona 3 Reload wallpaper as a bonus prize.",
                    'image' => 'img/persona3-reload-wallpaper.png',
                    'downloads' => [
                        ['label' => 'Desktop', 'link' => 'img/persona3-reload-wallpaper.png'],
                        ['label' => 'Mobile', 'link' => 'img/persona3-reload-wallpaper-mobile.png'],
                    ],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Drive',
                'tasks' => [
                    ['api_key' => 'm2_a1', 'label' => 'Follow ATLUS SEA on Facebook', 'link' => 'https://www.facebook.com/Atlus.asia/'],
                    ['api_key' => 'm2_a2', 'label' => 'Follow @atlus.sea on Instagram', 'link' => 'https://www.instagram.com/atlus.sea/'],
                ],
                'bonus' => [
                    'description' => "Here is a S.E.E.S. Missions avatar frame as a bonus prize.",
                    'image' => 'img/frame.png',
                    'downloads' => [
                        ['label' => 'Download', 'link' => 'img/frame.png'],
                    ],
                ],
            ],
            [
                'id' => 3,
                'title' => 'Unity',
                'tasks' => [
                    ['api_key' => 'm3_a1', 'label' => 'Join the ATLUS SEA Discord', 'link' => 'https://discord.com/invite/atlussea/'],
                ],
                'bonus' => [
                    'description' => "Screenshot this and send your image to the ATLUS SEA Discord to claim your exclusive S.E.E.S. Missions role.",
                    'image' => '',
                    'downloads' => [],
                ],
            ],
            [
                'id' => 4,
                'title' => 'Dedication',
                'is_final' => true,
                'bonus' => [
                    'description' => "Here is an exclusive Persona 3 Reload Nintendo Switch 2 paper cover as a bonus prize.",
                    'image' => 'img/paper-cover.jpg',
                    'downloads' => [],
                ],
            ]
        ];

        return $missions;
    }

    public function index(Request $request)
    {
        if (!$request->session()->has('api_token')) {
            return redirect('/')->with('error', 'Please log in to continue.');
        }

        $missions = $this->getMissions();
        $username = session('username');
        $email = session('email');
        return view('missions', compact('missions', 'username', 'email'));
    }
}
