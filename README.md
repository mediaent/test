Yii 2 Парсинг и подстчёт тегов XML файлов
============================


Установка
------------

### GIT
Клонировать репозиторий
~~~
git clone https://github.com/mediaent/test.git
~~~

После клонирования, для Linux, установить права на директирии

`runtime` - 0777
`web/assets` - 0777

настроить соеденение с базой данных, перейти в директорию с приложением и выполнить команду

~~~
./yii migrate
~~~

### ZIP
Распаковать архив

После распаковки, для Linux, установить права на директирии

`runtime` - 0777
`web/assets` - 0777

настроить соеденение с базой данных, перейти в директорию с приложением и выполнить команду

~~~
./yii migrate
~~~



Настройка соеденения с Базой данных
-------------

Отредактируйте файл `config/db.php`, например:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```