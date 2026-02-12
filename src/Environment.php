<?php

namespace worlddevs\uptimerobot;

class Environment {
    private static ?Environment $me = null;
    private static ?String $endpoint = null;
    private static ?String $api_key = null;
    private static Array $options = [];

    /**
     * 
     * @param string $endpoint 
     * @param string $api_key 
     * @param array $guzzle_options 
     * @return void 
     */
    protected function __construct(String $endpoint, String $api_key, array $guzzle_options) {
        self::$endpoint = $endpoint;
        self::$api_key = $api_key;
        self::$options = $guzzle_options;
    }

    /**
     * Call this to set everything up.
     * 
     * @param string $endpoint 
     * @param string $api_key 
     * @param array $guzzle_options 
     * @return void 
     */
    public static function configure(String $endpoint, String $api_key, array $guzzle_options = []) {
        if( self::$me === null ) {
            self::$me = new Environment($endpoint, $api_key, $guzzle_options);
        }
    }

    /**
     * Return current Environment
     * 
     * @return null|Environment 
     */
    public static function getEnvironment(): ?Environment {
        return self::$me;
    }

    /**
     * Return API endpoint
     * 
     * @return null|string 
     */
    public static function getEndpoint(): ?String {
        return self::$endpoint;
    }

    /**
     * Returns API key
     * 
     * @return null|string 
     */
    public static function getApiKey(): ?String {
        return self::$api_key;
    }

    /**
     * Returns Guzzle options that were set.
     * 
     * @return array 
     */
    public static function getOptions(): Array {
        return self::$options;
    }
}