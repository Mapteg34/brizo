# README #

Проект представляет собой прохождения тестового задания для компании brizo

# Постановка задачи #

#### Условия

Api библиотеки на базе Laravel + MySQL 8.

В библиотеке хранятся книги, у каждой книги может быть как один, так и несколько авторов. Добавьте возможность хранения данных о выдаче книги на руки.

1. Наполнить тестовую базу.
2. Создать CRUD для книг и авторов + поиск книг по названию или имени автора.
3. Написать метод получения статистики выдачи книг на руки за произвольный перирд. Мы хотим получить данные (месяц, книга, количество за месяц). Предусмотреть в ответе получение общих данных по годам и за все время работы библиотеки.
4. Написать тесты для api.

Пожелания:
	Контроллеры не должны содержать логику работы, максимально использовать функционал Laravel.

### How do I get set up? ###

Для разворачивания проекта необходимо:
1. `git clone`
2. create .env (see .env.default)
3. `composer install`
4. `docker-compose up -d`
5. edit docker-compose.override.yml, change web port, sample:
```
version: '3'
services:
  web:
    ports:
      - 80:80
```

Для запуска тестов:
```make test```

### Готовые ссылки ###

* https://brizo.malahov-artem.ru/
