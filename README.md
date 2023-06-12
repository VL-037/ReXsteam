<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# ReXsteam

Mini https://store.steampowered.com website.

### Preview

https://github.com/VL-037/ReXsteam/assets/68309124/9c060c5b-95da-47fa-803a-b1bfc0ca50ad

### To run this project, please do the following:

Make sure you have these tools
| Tool              | Detail |
|-------------------|--------|
| PHP               | https://www.php.net/downloads.php |
| Composer          | https://getcomposer.org/download |
| XAMPP             | https://sourceforge.net/projects/xampp |

- Create a .env file in the root directory and add the following code
```
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:I+Hz+rXhhVMR0KhqvE6/hNUhfvScExxX2giFRi55ITM=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rexsteam
DB_USERNAME=root
DB_PASSWORD=
```

- Run MySQL & Apache from `XAMPP`

- Open http://localhost/phpmyadmin

- Create a database same to `DB_DATABASE` .env variable

- Then run the following commands to start the app
```
composer install
php artisan migrate:fresh --seed
php artisan serve
```
