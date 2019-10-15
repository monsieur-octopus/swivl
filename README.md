# swivl

## Установка
1. Первым делом нужно склонировать проект в нужный каталог:
    ```
    cd /my/directory/project
    git clone https://github.com/monsieur-octopus/swivl.git .
    ```
2. Запускаем установку пакетов из composer: 
    ```
    composer install
    ```
3. В файле `.env` указываем правильные доступы к бд в строке `DATABASE_URL`
4. Если бд еще не создана - создаем выполняя запрос:
   ```
   php bin/console doctrine:database:create
   ```  
5. Накатываем миграции для создания нужных для приложения таблиц:
   ```
   php bin/console doctrine:migrations:migrate
   ```   
6. Последним шагом настраиваем хост чтобы он "смотрел" на `public/` каталог нашего проекта. Здесь все зависит от окружения: apache/nginx или, возможно. symfony dev server.

DONE!

 

## Api документация

***Получение класса***

URL: `/classroom/{id}`

метод: `GET`

---

***Получение списка классов***

URL: `/classroom/all/{page}` (page начинается с 1)

метод: `GET`

---

***Удаление класса***

URL: `/classroom/{id}`

метод: `DELETE`
 
 ---

***Добавление нового класса***

URL: `/classroom`

метод: `POST`

структура json-запроса:
```json
{
	"name": "Here_your_classname"
}
```

---

***Редактирование класса***

URL: `/classroom/{id}`

метод: `PATH`

структура json-запроса:
```json
{
	"name":   "Here_your_classname",
	"active": true/false
}
```
*Во время обновления можно указать как все нужные поля, так и одно 

---

***Изменение активности класса***

URL: `/classroom/{id}/active/{0|1}`

метод: `PATH`
