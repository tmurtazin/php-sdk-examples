<?php

use function Chatium\Actions\showToast;
use function Chatium\Actions\updateCurrentScreenBlock;
use function Chatium\Actions\apiCall;
use function Chatium\Responses\ApiCallResponse;
use function Chatium\Blocks\InlineVideo;
use function Chatium\Blocks\Button;
use function Chatium\Blocks\Text;
use function Chatium\Responses\ScreenResponse;
use function Chatium\Types\Screen;

require_once __DIR__ . "/../../../vendor/autoload.php";

function demoSlides()
{
    $slides = [
        [
            "imageUrl" => "https://fs.chatium.io/fileservice/file/thumbnail/h/video_OW1jS7ZYrK.d56.m4v/s/800x?offset=0s",
            "url" => "https://videos-8b305284-cdn-integros-com.akamaized.net/videos/nzaf4vK82NfUcSbsubcutW/mp4/360.mp4",
            "hlsUrl" => "https://hls-test.cache.integros.io/vod/6907d192/4EZB8TLXtx8ykvvwGnoogT/master.m3u8",
            "overlay" => [
                "blocks" => [
                    Text([
                        "text" => "Сопроводительный текст для первого слайда",
                        "color" => "white",
                        "containerStyle" => [
                            "bgColor" => "brown",
                            "marginBottom" => 30,
                            "paddingLeft" => 20
                        ],
                    ]),
                ]
            ]
        ],
        [
            "imageUrl" => "https://fs.chatium.io/fileservice/file/thumbnail/h/video_9ZY1n0qVQJ.d67.m4v/s/800x?offset=0s",
            "url" => "https://videos-8b305284-cdn-integros-com.akamaized.net/videos/5qo7wWziLMa8iTsccCn9KX/mp4/360.mp4",
            "hlsUrl" => "https://hls-test.cache.integros.io/vod/6907d192/fdv87C6d3y7vxvk3BbFHDp/master.m3u8",
            "overlay" => [
                "blocks" => [
                    Text(["text" => "Сопроводительный текст для второго слайда", "color" => "white"]),
                    Button(["title" => "Кнопка на втором слайде"])
                ]
            ]
        ],
        [
            "imageUrl" => "https://fs.chatium.io/fileservice/file/thumbnail/h/video_nP9MHifMZu.d36.m4v/s/800x?offset=0s",
            "url" => "https://videos-8b305284-cdn-integros-com.akamaized.net/videos/a6w9ZWnTpyoE9pNKzAZ13r/mp4/360.mp4",
            "hlsUrl" => "https://hls-test.cache.integros.io/vod/6907d192/qNmYxxSupEZ2PRyVUFWETk/master.m3u8",
            "overlay" => [
                "blocks" => [
                    Button([
                        "id" => "button3",
                        "title" => "Постучаться в API",
                        "onClick" => apiCall(Flight::request()->referrer . "my-api")
                    ])
                ]
            ]
        ]
    ];

    $formattedSlides = [];

    foreach ($slides as $key => $slide) {
        $formattedSlides[] =
            [
                "id" => "slide{$key}",
                "stretchContent" => true,
                "content" => InlineVideo([
                    "id" => "slide{$key}/video",
                    "imageUrl" => $slide["imageUrl"],
                    "url" => $slide["url"],
                    "hlsUrl" => $slide["hlsUrl"],
                    "videoSize" => [
                        "width" => 900,
                        "height" => 1600
                    ],
                    "videoAspectRatio" => [9, 16],
                    "repeat" => false,
                    "ignoreSilentSwitch" => "ignore",
                    "showControls" => "compact",
                    "resizeMode" => "cover",
                ]),
                "overlay" => $slide["overlay"]
            ];
    }

    return $formattedSlides;
}

Flight::route("/", function () {
    Flight::json(
        ScreenResponse(
            Screen(
                [
                    "title" => "Полноэкранные сторис",
                    "fullScreenStories" => [
                        "id" => "fullScreenStories/1",
                        "stories" => [
                            [
                                "id" => "story/slide0/1",
                                "slides" => demoSlides(),
                            ]
                        ]
                    ]
                ],
                [
                    Text([
                        "text" => "Пожалуйста, обновите приложение Chatium и php-sdk",
                        "containerStyle" => [
                            "default" => false,
                            "marginTop" => 20,
                            "marginLeft" => 20,
                        ]
                    ]),
                ]
            )
        )
    );
});

Flight::route("/my-api/", function () {
    Flight::json(
        ApiCallResponse([
            showToast("Сообщение от API"),
            updateCurrentScreenBlock("button3", [
                "title" => "Успешно сходили в API"
            ])
        ])
    );
});


Flight::start();
