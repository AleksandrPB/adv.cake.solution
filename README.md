Решение задания для вакансии Junior PHP Developer в компании Adv.Cake
=========
##### Техническое задание
Напиши метод, который принимает на вход строку и меняет порядок букв в каждом слове на обратный с сохранением регистра и пунктуации.
Например:
```
$result = revertCharacters("Привет! Давно не виделись.");
echo $result; // Тевирп! Онвад ен ьсиледив.
```
Также напиши unit-тесты для этого метода.

##### Для запуска решения убедитесь, что у вас установлены следующие приложения:
* GIT
* Docker, Docker-compose

Запуск
-----
Внутри директории в которой находится директория проекта выполните следующую команду для клонирования laradock:
```
$ git clone https://github.com/laradock/laradock.git
$ cd laradock

$ composer install
$ composer dump -o
```
Cкопируйте и переименуйте файл env-example в .env (в котором определяются переменные окружения):
```
$  cp env-example .env
```
Собираем необходимые нам контейнеры
```
$  docker-compose up -d workspace
```
Подключаемся к workspace и переходим в директорию решения
```
$  docker-compose exec workspace bash
$  cd adv.cake.solution
```
Устанавливаем PHPUnit и запускаем тест
```
$  composer require phpunit/phpunit
$  phpunit tests/ReverserTest.php 
```