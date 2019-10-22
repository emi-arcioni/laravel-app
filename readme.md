# Laravel Application Demo 
## by Emilio Arcioni
>This is a blog made in Laravel. You can register as user, post / delete / update your entries and list the other users posts. You can also handle your Twitter timeline.

## Installation
Checkout this repo into a folder of your choice.
Then you will need to setup this environment variables (located in the .env file):
- TWITTER_API_KEY
- TWITTER_API_SECRET 

The other variables that is a must to be completed are:
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

## Laravel initial setup
You must run `composer install` and `npm install` to initialize and install all libraries.

## Database and dummy data
You can run an `artisan` command to generate all tables in database and fill them with dummy data.
```
$ php artisan migrate --seed
```

## Testing
To run unit and feature tests: 
```
$ ./vendor/bin/phpunit --testdox
```

## Virtual Hosts

There's a file called *vhost.xml* that can be used as Apache Virtual Host.
Both attributes (*ServerName* and *DocumentRoot*) must be customized with your local settings.

You have to edit the *httpd.conf* file and add the path to this file. For example: `Include /Users/emilio/Sites/laravel-app/vhost.xml`

Then restart your apache
```
$ sudo apachectl restart
```