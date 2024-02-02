## Chikchika

Simple twitter clone written in Laravel. using livewire for some parts of the application


# Local setup:
1. clone repo
2. copy .env.example in .env
3. run command php artisan key:generate
4. create database.sqlite file in database folder
5. use path of the database.sqlite file in .env as value of key DB_DATABASE
6. run command php artisan migrate
7. run command php artisan serve

# General Todo:
1. Fix issues
2. Rewrite everything in livewire
3. How to make livewire layouts
4. Check out post like and unlike functionality with livewire
5. How to add middlewares on livewire methods (For example only authorised user can like or create post)
6. Why use policies and not FormRequests for authorizing user actions
7. How to implement load more functionality without jquery
8. Home livewire component not working as desired
