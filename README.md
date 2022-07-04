# Тестовое задание

## Установка
1. `composer install`
2. `npm install`
3. провести миграции `php artisan migrate`
4. Провести записи в бд: `INSERT INTO equipment_types (id, type_name, serial_number_mask) VALUES (1, 'TP-Link TL-WR74', 'XXAAAAAXAA'),(2, 'D-Link DIR-300', 'NXXAAXZXaa'), (3, 'D-Link DIR-300 S', 'NXXAAXZXXX');`
4. запустить сервер `php artisan serve`
5. Перейти по адресу `http://127.0.0.1:8000/api/equipment?api_token=`
   api_token указать из **config/apitokens**. *Реализация Bearer Token из ТЗ*

На первой странице выводятся записи, что бы создать их нажми **Создать Запись**

При клике на показать можно посмотреть всю информацию о сотруднике
