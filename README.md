Yii 2 Basic Project Template
============================


Установка
------------

### GIT
Клонировать репозиторий
~~~
git clone https://github.com/mediaent/test.git
~~~

После клонирования установить права на деректирии

`runtime` - 0777
`web/assets` - 0777

настроить соеденение с базой данных, перейти в дерикторию с приложением и выполнить команду

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