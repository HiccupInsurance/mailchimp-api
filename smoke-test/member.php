<?php

require(__DIR__ . '/../vendor/autoload.php');

use Hiccup\MailChimpApi\MailChimp;
use Noodlehaus\Config;

$config = new Config(__DIR__ . '/../config.yml');
$mailChimp = new MailChimp($config->get('api_key'));

$response = $mailChimp->getMember()->subscribe(
    $config->get('list_id'),
    [
        'email_address' => 'budi.arsana@hiccup.co'
    ]
);

var_dump($response);
var_dump('sample gpg');
