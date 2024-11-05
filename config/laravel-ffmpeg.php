<?php

return [
    'default_disk' => 'local',

    'ffmpeg' => [
        //'binaries' => env('FFMPEG_BINARIES', 'ffmpeg'),
        //'ffmpeg.binaries' => '/usr/bin/ffmpeg', 
        'ffmpeg.binaries'  => 'C:/FFmpeg/bin/ffmpeg.exe',
        'threads' => 12,
    ],

    'ffprobe' => [
        //'binaries' => env('FFPROBE_BINARIES', 'ffprobe'),
        //'ffprobe.binaries' => '/usr/bin/ffprobe',//
        'ffprobe.binaries' => 'C:/FFmpeg/bin/ffprobe.exe',
    ],

    'timeout' => 3600,
];
