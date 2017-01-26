# StarWars Basic PHP WebApp

In order to run this app, you need to have `composer` and `php` installed.

You also need to set the ClientSecret, ClientId, Domain and Callback URL for your Auth0 app as environment variables with the following names respectively: `AUTH0_CLIENT_SECRET`, `AUTH0_CLIENT_ID`, `AUTH0_DOMAIN` and `AUTH0_CALLBACK_URL`.

Clone this project, then rename `.env.example` to `.env` and fill them with right values.

````bash
# .env file
AUTH0_CLIENT_SECRET=myCoolSecret
AUTH0_CLIENT_ID=myCoolClientId
AUTH0_DOMAIN=yourDomain.auth0.com
AUTH0_CALLBACK_URL=http://your.url/
````

Once you've set those 4 environment variables, just run the following to get the app started:

````bash
composer install
php -S localhost:3000
````

Now, try calling [http://localhost:3000/](http://localhost:3000/)
