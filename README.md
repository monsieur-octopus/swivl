# swivl

###### Установка
1. Первым делом нужно склонировать проект в нужный каталог:
```
```
5. Далее настраиваем хост чтобы он "смотрел" на public каталог проекта. Здесь все зависит от окружения: apache/nginx или возможно symfony dev server.
2. 

###### Комментарии
 - 1
 - 2
 

###### Api документация

***Получение класса***

URL: `/classroom/{id}`

метод: `GET`


***Получение списка классов***

URL: `/classroom/all/{page}` (page начинается с 1)

метод: `GET`


***Удаление класса***

URL: `/classroom/{id}`

метод: `DELETE`
 

***Добавление нового класса***

URL: `/classroom`

метод: `POST`

структура json-запроса:
```json
{
	"name": "Here_your_classname"
}
```


***Редактирование класса***

URL: `/classroom/{id}`

метод: `PATH`

структура json-запроса:
```json
{
	"name":   "Here_your_classname",
	"active": true | false
}
```


***Изменение активности класса***

URL: `/classroom/{id}/active/{0|1}`

метод: `PATH`
