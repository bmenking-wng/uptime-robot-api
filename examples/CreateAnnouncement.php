<?php
/*
 * Create Announcement Example
 * 
 * Script expects `composer install` has been run in the parent directory and the .env file exists,
 * containing UPTIMEROBOT_ENDPOINT and UPTIMEROBOT_API_KEY 
 * 
 * Script pulls down Public status pages, finds one with the name 'Internal Status' and creates a
 * test announcement that lasts for 1 hour.
 * 
 */
require(__DIR__ . '/../vendor/autoload.php');

use worlddevs\uptimerobot\Environment;
use worlddevs\uptimerobot\Model\PSPAnnouncementModel;
use worlddevs\uptimerobot\Service\PublicStatusPageService;
use worlddevs\uptimerobot\Service\PSPAnnouncementService;

Dotenv\Dotenv::createImmutable(__DIR__ . '/../')->load(); // load .env file key/values into $_ENV

Environment::configure($_ENV['ENDPOINT'], $_ENV['API_KEY']);

// pull down Public status pages and find one named 'Internal Status'.  Exit on exception or not found.
try {
    $psps = PublicStatusPageService::search();

    $internal_psp = null;

    foreach($psps['data'] as $psp) {
        if( $psp['friendlyName'] == 'Internal Status' ) {
            $internal_psp = $psp;
            break;
        }
    }

    if( $internal_psp === null ) die("Could not find that Public status page" . PHP_EOL);    
}
catch(\Exception $e) {
    die("Unable to search PSPs: " . $e->getMessage() . PHP_EOL);
}

// Create an announcement.
try {   
    $model = new PSPAnnouncementModel();
    // the following attributes are from the schema https://uptimerobot.com/api/v3/#post-/psps/-pspId-/announcements
    $model->title = 'Test Announcement';
    $model->content = 'Hello, World!';
    $model->status = 'Published';
    $model->type = 'Info';
    $model->startDate = date('Y-m-d\TH:i:s\Z');
    $model->endDate = date('Y-m-d\TH:i:s\Z', strtotime("+1 hour"));    

    echo "Creating announcement" . PHP_EOL;
    
    PSPAnnouncementService::createAnnouncement($internal_psp['id'], $model);
}
catch(\Exception $e) {
    die("An error occurred when searching or creating announcement: " . $e->getMessage() . PHP_EOL);
}
