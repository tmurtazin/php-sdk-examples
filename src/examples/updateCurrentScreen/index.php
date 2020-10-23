<?php

require_once __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../helpers/randomText.php';

use function Chatium\Actions\apiCall;
use function Chatium\Actions\updateCurrentScreenBlock;
use function Chatium\Blocks\Button;
use function Chatium\Blocks\ListItem;
use function Chatium\Blocks\Text;
use function Chatium\Responses\ApiCallResponse;
use function Chatium\Responses\ScreenResponse;
use function Chatium\Types\Screen;

function ListPage($page = 0) {
    $pageSize = 10;
    $nextPage = $page + 1;

    return array_merge(
        array_map(function ($i) use ($pageSize, $page) {
            return ListItem([
                'title' => randomText(1),
                'description' => randomText(3),
                'logo' => [
                    'text' => (string) ($pageSize * $page + $i + 1),
                    'bgColor' => 'silver',
                ]
            ]);
        }, range(0, $pageSize - 1)),
        [
            Text([
                'id' => "page-$nextPage",
                'containerStyle' => ['default' => false],
            ], [
                Button([
                    'title' => 'Загрузить еще...',
                    'onClick' => apiCall("/page/$nextPage")
                ]),
            ]),
        ],
    );
}

Flight::route('/', function() {
    Flight::json(
        ScreenResponse(
            Screen(
                ['title' => 'Привет мир!'],
                ListPage()
            )
        )
    );
});

Flight::route('/page/@page', function($page) {
    Flight::json(
        ApiCallResponse([
            updateCurrentScreenBlock("page-$page", [
                'blocks' => ListPage($page)
            ])
        ])
    );
});

Flight::start();
