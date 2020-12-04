<?php
session_start();
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\Google;

$service = $this->httpGet('service');

switch ($service) {

    case 'github':
        $appClass = Github::class;
        $clientId = "166a6f347183a08babe7"; // $boot->env('githubId');
        $clientSecret = "b04c70bbf64dc921ee401c2d76105bab96e71b46"; //$boot->env('githubSecret');
        break;

    case 'google':
        $appClass = Google::class;
        $clientId = $boot->env('googleId');
        $clientSecret = $boot->env('googleSecret');
        break;
}

/** @var Google $provider */
$provider = new $appClass([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
]);

$authUrl = $provider->getAuthorizationUrl();

$_SESSION['state'] = $provider->getState();

$this->urlRedirect($authUrl);
