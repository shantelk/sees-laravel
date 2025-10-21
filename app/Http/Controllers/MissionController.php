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
                'links' => [
                    'https://cpn.sega-account.com/',
                ],
                'note' => 'Please use the same email as this campaign to qualify for a valid entry.',
                'bonus' => [
                    'description' => "Here's an exclusive Persona 3 Reload wallpaper as a bonus prize.",
                    'image' => 'img/wallpaper.png',
                    'downloads' => [
                        ['label' => 'Desktop', 'link' => 'img/wallpaper-d.png'],
                        ['label' => 'Mobile', 'link' => 'img/wallpaper-m.png'],
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
                'links' => [
                    'https://www.facebook.com/Atlus.asia/',
                    'https://www.instagram.com/atlus.sea/',
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
                    'Join the ATLUS SEA Discord',
                ],
                'links' => [
                    'https://discord.com/invite/atlussea/',
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

        return view('home', compact('missions'));
    }
}
