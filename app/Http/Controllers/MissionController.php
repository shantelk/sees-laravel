<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function showMissions()
    {
        $missions = [
            [
                'id' => 1,
                'title' => 'Contract',
                'tasks' => [
                    'Login or signup for a SEGA Account',
                ],
                'note' => 'Please use the same email as this campaign to qualify for a valid entry.',
                'bonus' => [
                    'description' => "Here's an exclusive Persona 3 Reload wallpaper as a bonus prize.",
                    'image' => 'img/wallpaper.png',
                    'downloads' => [
                        ['label' => 'Desktop', 'link' => 'downloads/mission1_desktop.jpg'],
                        ['label' => 'Mobile', 'link' => 'downloads/mission1_mobile.jpg'],
                    ],
                ],
            ],
            [
                'id' => 2,
                'title' => 'Drive',
                'tasks' => [
                    'Like / Follow ATLUS SEA on Facebook',
                    'Follow @atlus.sea on Instagram',
                ],
                'bonus' => [
                    'description' => "Here is a S.E.E.S. Missions avatar frame as a bonus prize.",
                    'image' => 'img/frame.png',
                    'downloads' => [
                        ['label' => 'Download', 'link' => 'downloads/mission2_frame.png'],
                    ],
                ],
            ],
            [
                'id' => 3,
                'title' => 'Unity',
                'tasks' => [
                    'Join the ATLUS SEA Discord',
                ],
                'bonus' => [
                    'description' => "Screenshot this and send your image to the ATLUS SEA Discord to claim your exclusive S.E.E.S. Missions role.",
                    'image' => '',
                    'downloads' => [],
                ],
            ],
        ];

        return view('home', compact('missions'));
    }
}
