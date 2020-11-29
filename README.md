## Installation
run clone command first:
```
git clone https://github.com/Mo7amad7amdy/otp.git
```
now enter to the project folder
```
cd otp/
```
Then run compose update
```
composer update
```
copy .env file and setup your DB and email account

now migrate DB tables
```
php artisan migrate
```
finally, run your project
```
php artisan serve
```
