<?php

use Hiccup\MailChimpApi\MailChimp;
use Noodlehaus\Config;

$config = new Config(__DIR__ . '/../config.yml');

$mailChimp = new MailChimp($config->get('api_key'));
$mailChimp->member();
