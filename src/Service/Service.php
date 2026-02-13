<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\UptimeRobot;

class Service {
    protected static function makeCall(String $path, String $method = 'GET', Array $query = [], Array $body = []): Array {
        $guzzle = UptimeRobot::getInstance();
        $options = [];

        if( $method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
            if( !empty($body) ) {
                $options['json'] = $body;
            }
        }
        else {
            if( !empty($query) ) {
                $options['query'] = $query;
            }
        }

        $response = $guzzle->request($method, $path, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}