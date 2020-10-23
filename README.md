# php-sdk-examples
Chatium PHP SDK examples

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
