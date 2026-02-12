<?php

namespace worlddevs\uptimerobot;

use GuzzleHttp\Client as GuzzleClient;

class UptimeRobot extends GuzzleClient {
    private static ?UptimeRobot $instance = null;

    public static function getInstance() {
        if( self::$instance == null ) {
            $options = array_merge(Environment::getOptions(), [
                'base_uri'=>Environment::getEndpoint(),
                'headers'=>[
                    'Authorization'=>"Bearer " . Environment::getApiKey()
                ]
            ]);

            self::$instance = new UptimeRobot($options);
        }

        return self::$instance;
    }
}