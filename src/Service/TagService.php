<?php

namespace worlddevs\uptimerobot\Service;

/**
 * 
 * @package worlddevs\uptimerobot\Service
 */
class TagService extends Service {
    /**
     * Get a paginated list of tags for the authenticated user, sorted by ID in ascending order
     * @param mixed $cursor 
     * @return array 
     */
    public static function search($cursor = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/tags", 'GET', $query);
    }

    /**
     * Delete a tag and remove it from all monitors
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/tags/$id", 'DELETE');
    }
}