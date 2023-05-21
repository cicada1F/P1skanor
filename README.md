# P1skanor

Проект "P1skanor"

Проект "Сайт-агрегатор поставщиков телекоммуникационных услуг" является веб-сайтом, написанным на PHP версии 8.1 с использованием других технологий. Он предоставляет функциональность для [описание функциональности или назначения проекта].
Требования к окружению

    PHP версии 8.1
    HTTP сервер: Apache 2.4 + PHP 8.0.8.1 + Nginx 1.23
    СУБД: MariaDB 10.8
    Платформа для локального хоста: OpenServer

Примечание: При различиях в версиях указанных компонентов могут возникать ошибки или непредвиденное поведение проекта.
Установка и запуск

    Создайте базу данных с названием "uchet" в системе управления базами данных, такой как phpMyAdmin.
    Импортируйте файл "uchet.sql" из папки "MashaDB" в созданную базу данных. Данный файл содержит необходимую структуру базы данных и начальные данные.
    Настройте соединение с базой данных, отредактировав файл "login.php". Внутри этого файла вы найдете инструкции по заполнению соответствующих полей, таких как имя пользователя и пароль для доступа к базе данных.
    Скопируйте файлы "php.ini" и "my.ini" из папки "MashaDB" в соответствующие директории вашей установки OpenServer:
        Файл "php.ini" скопируйте в директорию "modules\php\PHP_8.1" (для OpenServer).
        Файл "my.ini" скопируйте в директорию "modules\database\MariaDB-10.8-Win10" (для OpenServer).
    Запустите OpenServer и убедитесь, что серверы PHP и MariaDB работают корректно.
    Откройте веб-браузер и введите адрес сайта, чтобы получить доступ к главной странице проекта.

Структура проекта

    main.php: Главная страница сайта.
    login.php: Файл с настройками, включая параметры соединения с базой данных.
    css/: Папка с файлами стилей CSS.
    js/: Папка с файлами JavaScript.
    img/: Папка с изображениями.

Авторы

    Разработчик бэкэнда: Дмитрий
    Разработчик фронтенда: Денис
