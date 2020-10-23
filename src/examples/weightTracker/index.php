<?php

use function Chatium\Actions\refresh;
use function Chatium\Blocks\Button;
use function Chatium\Blocks\Image;
use function Chatium\Blocks\Text;
use function Chatium\Responses\ScreenResponse;
use function Chatium\Types\Screen;

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../helpers/randomText.php';

function toDigits($string) {
    list ($big, $small) = explode('.', $string);

    $digits = [
        ['url' => 'image_qP1kuhEoO0.90x146.png', 'width' => 90],
        ['url' => 'image_09Kv1xTLE7.56x143.png', 'width' => 56],
        ['url' => 'image_mJJfbM5gC0.97x144.png', 'width' => 97],
        ['url' => 'image_CDliXWltOW.91x146.png', 'width' => 91],
        ['url' => 'image_gapezy9cXC.103x143.png', 'width' => 103],
        ['url' => 'image_zaigLk2ctE.90x145.png', 'width' => 90],
        ['url' => 'image_F5MjYYWw9H.91x145.png', 'width' => 91],
        ['url' => 'image_wETzDJ7amB.97x143.png', 'width' => 97],
        ['url' => 'image_z9ljledyFY.91x146.png', 'width' => 91],
        ['url' => 'image_b4bFpVWzvZ.90x145.png', 'width' => 90],
    ];

    return Text([
        'containerStyle' => [
            'default' => false,
            'alignItems' => 'flex-end',
            'justifyContent' => 'center',
            'flexDirection' => 'row',
            'marginTop' => 50,
        ]
    ], array_merge(
        array_map(function ($number) use ($digits) {
            return Image([
                'downloadUrl' => 'https://fs.chatium.io/fileservice/file/download/h/' . $digits[$number]['url'],
                'containerStyle' => [
                    'default' => false,
                    'width' => $digits[$number]['width'],
                    'flexGrow' => 0,
                    'marginRight' => 10,
                ]
            ]);
        }, str_split($big)),
        array_map(function ($number) use ($digits) {
            return Image([
                'downloadUrl' => 'https://fs.chatium.io/fileservice/file/download/h/' . $digits[$number]['url'],
                'containerStyle' => [
                    'default' => false,
                    'width' => round($digits[$number]['width'] / 2),
                    'flexGrow' => 0,
                ]
            ]);
        }, str_split($small)),
    ));
}

Flight::route('/', function() {
    Flight::json(
        ScreenResponse(
            Screen(
                ['title' => 'Привет мир!'],
                [
                    toDigits(rand(53, 109) . '.' . rand(0, 9)),
                    Button([
                        'title' => 'Ещё!',
                        'onClick' => [refresh()],
                            'containerStyle' => [
                                'marginTop' => 150,
                            ]
                    ]),
                ]
            )
        )
    );
});

Flight::start();
