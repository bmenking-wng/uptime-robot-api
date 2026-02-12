<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\UptimeRobot;
use Psr\Http\Message\ResponseInterface as Response;

class Service {
    protected static function makeCall(String $path, String $method = 'GET', Array $query = [], String $body = null, Array $additional_headers = []): Array {
        $guzzle = UptimeRobot::getInstance();

        return json_decode($guzzle->request($method, $path, [
            'query'=>$query
        ])->getBody()->getContents(), true);
    }
}