<?php

require(__DIR__ . '/../vendor/autoload.php');

use Doctrine\Common\Annotations\AnnotationRegistry;
use Hiccup\MailChimpApi\Api\MemberApi;
use Hiccup\MailChimpApi\MailChimpConfig;
use Hiccup\MailChimpApi\Model\Member;
use Noodlehaus\Config;

// You will need to define this on your framework or app integration
AnnotationRegistry::registerLoader('class_exists');

$config = new Config(__DIR__ . '/../config.yml');
$client = new MailChimpConfig($config->get('api_key'));
$memberApi = new MemberApi($client);

$member = new Member();
$member->setEmailAddress('budi.arsana@vroomvroomvroom.com.au');
$member->setMergeFields([
    'FNAME' => 'Budi',
    'LNAME' => 'Arsana'
]);

$response = $memberApi->subscribe(
    $config->get('list_id'),
    $member
);

var_dump($response);
