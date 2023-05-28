### Laravel GSES2 BTC application

Для роботи додатку потрібно в змінних середовища (.env) додати налаштування для smtp серверa:

`MAIL_MAILER=smtp`  
`MAIL_HOST=smtp.gmail.com`  
`MAIL_PORT=587`  
`MAIL_USERNAME=<email>`  
`MAIL_PASSWORD=<password>`  
`MAIL_ENCRYPTION=tls`  
`MAIL_FROM_ADDRESS=<from>`  
`MAIL_FROM_NAME="${APP_NAME}"`  

Для запуску додатку потрібно в кореневому каталозі в терміналі виконати команду `docker build -t <your_app_name> .`. З допомогою команди `docker image ls` визначити `іmageID` щойноствореного образу та використати в команді `docker run -p 8000:8000 -d <imageID>`. В результаті контейнер буде запущено.

Далі необхідно запустити сервер. Для цього спочатку потрібно дізнатися id контейнера з допомогою `docker ps` та виконати команду `docker exec -it <container ID> sh`. В командному рядку контейнера необхідно виконати `php artisan serve --host=0.0.0.0`. 

Якщо сервер працює, тоді на [http://localhost:8000/api/rate](http://localhost:8000/api/rate) можна дізнатися поточний курс BTCUAH.

Для запитів використовувалася api [Binance](https://www.binance.com/en/binance-api).