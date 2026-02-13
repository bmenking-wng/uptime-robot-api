<?php

namespace worlddevs\uptimerobot\Service;

class UserService extends Service {
    /**
     * Get current user
     * @return array<string, mixed> 
     */
    public static function retrieve(): array {
        return self::makeCall("/v3/user/me");
    }

    /**
     * Get alert contacts
     * @return array<string, mixed> 
     */
    public static function alertContacts(): array {
        return self::makeCall("/v3/user/alert-contacts");
    }

    /**
     * Get all alert contacts including personal, notify-only, and organization members alert contacts
     * @return array<string, mixed> 
     */
    public static function allAlertContacts(): array {
        return self::makeCall("/v3/user/all-alert-contacts");
    }
}