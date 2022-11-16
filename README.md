# myown-blog

A Laravel package is a set of reusable classes created to add extra functionality to a Laravel website. In clearer terms, 
a package is to Laravel, what plugins are to WordPress. The primary goal of Laravel packages is to reduce development time
by making reusable features into a set of standalone classes that can be used within any Laravel project.

Insatall Package in your laravel project

composer require myown/blog

Add this line in config/app.php in providers array

myown/blog/BlogServiceProvider::class,

migrate the package database in your database

php artisan migrate --path=vendor/myown/blog/src/migrations

And finally, start the application by running:

php artisan serve

Visit http://localhost:8000/blogs in your browser to view the demo.

Some Note
//You need to add some authors data in author table
