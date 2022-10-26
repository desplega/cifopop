## Cifopop

Application based on Laravel to publish adverts for second hand products. Users can make offers and reach an agreement with the seller.

Clone repository and run
```
composer install
```
You may need to run ```composer update``` instead, if some dependencies are not found.
Create the `.env` file with your project, database, and smtp own configuration. Generate the unique key.
```
php artisan key:generate
```
Install Breeze
```
php artizan breeze:install
```
Now you can run the migrations
```
php artisan migrate
```
Finally run Vite server to dynamically generate new styles
```
npm install
npm run dev
```
