<?php


global $boot;

use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\Github;
use League\OAuth2\Client\Provider\Instagram;

$service = $this->httpGet('service');
$this->sessionSet('service', $service);

switch ($service) {

    case 'github':
        $appClass = Github::class;
        $clientId = $boot->env('githubClientId');
        $clientSecret = $boot->env('githubClientSecret');
        break;

    case 'google':
        $appClass = Google::class;
        $clientId = '45333273610-uqsgn75fngr5su6gonhmm7s24qejphp9.apps.googleusercontent.com';
        $clientSecret = 'hyL8x0T88vKJy5R0VZBhBJMO';
        break;

    case 'instagram':
        $appClass = Instagram::class;
        $clientId = '660368684523935';
        $clientSecret = 'a20c0a6e29241546f9a31630f29d752c';
        break;

    case 'facebook':
        $appClass = Facebook::class;
        $clientId = '605028320101753';
        $clientSecret = '41426864ab1ed9161a2bd6f790631b7a';
        break;
}

/** @var Google $provider */

$provider = new $appClass([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'graphApiVersion' => 'v2.10',

]);

$authUrl = $provider->getAuthorizationUrl();
$state = $provider->getState();

// vdd('d');
return $this->urlRedirect($authUrl);

