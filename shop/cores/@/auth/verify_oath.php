<?php

/** @var ZView $this */
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Google;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

$service = $this->sessionGet('service');

global $boot;
switch ($service) {
    case 'github':
        $provider = new Github([
            'clientId' => $boot->env('githubClientId'),
            'clientSecret' => $boot->env('githubClientSecret'),
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


$token = $provider->getAccessToken('authorization_code', [
    'code' => $this->httpGet('code')
]);

$data = $provider->getResourceOwner($token);
if(Az::$app->cores->auth->oauthCheck($data->toArray())){
    $this->urlRedirect($this->urlGetBase());
}else{
    $this->urlRedirect(['/cores/auth/user_register']);
}


