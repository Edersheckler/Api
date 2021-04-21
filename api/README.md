# Lumen-passport-firebird

Lumen-passport-firebird
## Run this from your local or a remote command line to generate a random 32-character Lumen APP_KEY:

> php -r "echo bin2hex(random_bytes(16));"


## Run serve
    
> php -S localhost:8000 -t ./public


# Create new tables for Passport
    php artisan migrate

# Install encryption keys and other necessary stuff for Passport
    php artisan passport:install

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
