<?php

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

require __DIR__ . '/dotenv-loader.php';

use Auth0\SDK\API\Authentication;

$domain        = getenv('AUTH0_DOMAIN');
$client_id     = getenv('AUTH0_CLIENT_ID');
$client_secret = getenv('AUTH0_CLIENT_SECRET');
$redirect_uri  = getenv('AUTH0_CALLBACK_URL');

$auth0 = new Authentication($domain, $client_id);

$auth0Oauth = $auth0->get_oauth_client($client_secret, $redirect_uri, [
  'persist_id_token' => true,
  'persist_refresh_token' => true,
]);

$starWarsNames = ['Darth Vader', 'Ahsoka Tano', 'Kylo Ren', 'Obi-Wan Kenobi', 'R2-D2', 'Snoke'];

$userInfo = $auth0Oauth->getUser();

if (isset($_REQUEST['logout'])) {
    $auth0Oauth->logout();
    session_destroy();
    header("Location: /");
}

?>
<html>
    <head>
        <script src="http://code.jquery.com/jquery-3.0.0.min.js" type="text/javascript"></script>
        <script src="https://cdn.auth0.com/js/lock/10.0/lock.min.js"></script>

        <script type="text/javascript" src="//use.typekit.net/iws6ohy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
 
        <!-- font awesome from BootstrapCDN -->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">

        <script>
          var AUTH0_CLIENT_ID = '<?php echo getenv("AUTH0_CLIENT_ID") ?>';
          var AUTH0_DOMAIN = '<?php echo getenv("AUTH0_DOMAIN") ?>';
          var AUTH0_CALLBACK_URL = '<?php echo getenv("AUTH0_CALLBACK_URL") ?>';
        </script>


        <script src="public/app.js"> </script>
        <link href="public/app.css" rel="stylesheet">



    </head>
    <body class="home">
        <div class="container">
            <div class="login-page clearfix">
              <?php if(!$userInfo): ?>
              <div class="login-box auth0-box before">
                <img src="https://cdn.auth0.com/blog/app/star_warsapp.png" />
                <p>Heard you don't want to migrate to PHP 7? Dare us!</p>
                <a class="btn btn-primary btn-login">SignIn</a>
              </div>
              <?php else: ?>
              <div class="logged-in-box auth0-box logged-in">
                <h1 id="logo">Star Wars Welcomes You to the Family!</h1>
                <img class="avatar" width="200" src="<?php echo $userInfo['picture'] ?>"/>

                <h2>Welcome <span class="nickname"><?php echo $userInfo['nickname'] ?></span></h2>
                <h2> Assigned Codename : <b><?php echo $starWarsNames[rand(0, 6)]; ?></b> </h2>
                <a class="btn btn-primary btn-lg" href="?logout">Logout</a>
              </div>
              <?php endif ?>
            </div>
        </div>
    </body>
</html>
