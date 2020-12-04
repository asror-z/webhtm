<?php

session_start();
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;

$service = $this->httpGet('service');

switch ($service) {
    case 'github':
        $provider = new Github([
            'clientId' => '827f968eed55608d2a37',
            'clientSecret' => 'bf2b186492fd8d81731f0c0e4ae2518a44f14591',
        ]);
        break;

    case 'google':
        $provider = new Google([
            'clientId' => '45333273610-uqsgn75fngr5su6gonhmm7s24qejphp9.apps.googleusercontent.com',
            'clientSecret' => 'hyL8x0T88vKJy5R0VZBhBJMO',
        ]);
        break;

    case 'facebook':
        $provider = new Facebook([
            'clientId' => '2224372611008062',
            'clientSecret' => '8b6535bd177b9c7a70943bc196e6f671',
            'redirectUri'       => '/cores/auth/verify_oath.aspx',
            'graphApiVersion'   => 'v2.10',
        ]);
        break;
   
}


//$state = $this->httpGet('state');
//
//if (empty($state))
//    vdd('state is empty');
//
//$oauth2state = $_SESSION['state'];
//
//if (empty($oauth2state))
//    vdd('Invalid state');
//
//if($oauth2state !== $state)
//    vdd('Invalid state');
    
$token = $provider->getAccessToken('authorization_code', [
    'code' => $this->httpGet('code')
]);

$data = $provider->getResourceOwner($token);

$mas = $data->toArray();
echo "<pre>";
echo vdd($mas);
echo "</pre>";

