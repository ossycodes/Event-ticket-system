##Online-Event-Ticket-System

    git clone https://github.com/osaigbovoemmanuel1/Online-Event-Ticket-System.git
    cp.env.example .env
    php artisan key:generate

#Create a database (with mysql or postgresql)
#And update .env file with database credentials
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_DATABASE=etms
    DB_USERNAME=root
    DB_PASSWORD=

#Install Composer dependencies
    composer install

#Run your migrations
    php artisan migrate
    php artisan serve

#Features

Online event ticket booking platform in laravel.

    Admin portal
        -perform crud operations on events
        -perform crud operations on blogposts
        -manage newsletter subscribers.
        -send email/notifications to users
        -manage contact us queries
        -view transactions 
        -manage all events, users, transactions
        -activate/de-activate events uploaded by users
        -activate/de-activate comments posted by users
        -manage slider images in frontend
        -etc
    User portal
        -manage transactions, purchase ticket to events
        -upload events etc
        -comment on uploaded events etc
