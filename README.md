# laravel-mongodb-passport-fix
Updates passport models to use the MongoDB Models

This will add a console command to automatically update the `Illuminate\Database\Eloquent\Model` models in the Passport vendor files to include `Jenssegers\Mongodb\Eloquent\Model` instead.

# Installation
Move `MongoDBPassportFix.php` to `app/Console/Commands`. You may need to create the Commands folder

# How to Run
Just run `php artisan fix:passport` and that is all

This will need to be run everytime Laravel Passport is updated

You can revert these changes by running `php artisan fix:passport --rollback`
