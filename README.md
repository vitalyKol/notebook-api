


## Api notebook

Программный интерфейс сделан для тестого задания. Не добавлены авторизация и аунтификация.

## Требования к заданию
Структура методов:

1. GET /api/v1/notes/
2. POST /api/v1/notes/
3. GET /api/v1/notes/{id}/
4. PUT /api/v1/notes/{id}/
5. DELETE /api/v1/notes/{id}/

Добавлены поля для POST записной книжки:

1. ФИО (обязательное)
2. Компания
3. Телефон (обязательное)
4. Email (обязательное)
5. Дата рождения
6. Фото

Добавлена возможность выводить информацию в списке по страничною

На странице <a href="http://notebook/public/api/documentation/">http://notebook/public/api/documentation/</a> находится документация swagger

Тестировалось приложение через программу Postman, коллекция запросов находится по адресу public/api/test-api.postman_collection.json
Для наполнения БД использовал фабрику и посев в ларавел. Миграция таблицы notes для БД notebook присутствует.
