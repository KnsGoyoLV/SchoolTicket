<?php 
    require_once("connectDB.php");
    require "vendor/autoload.php";

    $env = parse_ini_file('.env');
    session_start();

    
    $url = 'https://login.microsoftonline.com/common/oauth2/logout';
    $data = array(
        'token' => $refresh_token,
        'token_type_hint' => 'refresh_token',
        'client_id' => $env['client_id'],
        'post_logout_redirect_uri' => $env['logout'],
        'client_secret' => $env['client_secret']
    );
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */ }
    unset($_SESSION['t']);
    unset($_SESSION['state']);
    unset($_SESSION['access_token']);
    session_destroy();
    header('Location: '.$env['logout']);
?>

