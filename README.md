# php-sdk-examples
Chatium PHP SDK examples

После клонирования репозитория выполнить:
```
cd php-sdk-examples
composer install
```

## updateCurrentScreen

Запускаем локально на любом порту (например, 8900)
```
php -S 127.0.0.1:8900 -t src/examples/updateCurrentScreen/
```

Запускаем туннель для тестирования на любом префиксе (например, bahd239)
```
# префикс и порт
dev-tunnel --domain=bahd239 8900
```

Запускаем
```
https://chatium.com/app/testium.bahd239/
```

После завершения тестирования остановить процессы туннеля и php, чтобы освободить выбранный префикс (например, bahd239) 

## weightTracker

Аналогично предыдущему примеру, за исключением пути к папке
```
php -S 127.0.0.1:8900 -t src/examples/weightTracker/
```

## fullScreenStories

Аналогично предыдущему примеру, за исключением пути к папке
```
php -S 127.0.0.1:8900 -t src/examples/fullScreenStories/
```
