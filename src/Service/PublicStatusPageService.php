<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\PublicStatusPageModel;

/**
 * 
 * @package worlddevs\uptimerobot\Service
 */
class PublicStatusPageService extends Service {
    /**
     * List Public Status Pages.
     * @param mixed $cursor 
     * @return array 
     */
    public static function search($cursor = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/psps", 'GET', $query);
    }

    /**
     * Create a public status page.
     * @param PublicStatusPageModel $model 
     * @return array|bool 
     */
    public static function create(PublicStatusPageModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/psps", 'POST', $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * 
     * @param mixed $id 
     * @return array 
     */
    public static function retrieve($id): array {
        return self::makeCall("/v3/psps/$id");
    }

    /**
     * 
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/psps/$id", 'DELETE');
    }

    /**
     * Update a public status page.
     * @param mixed $id 
     * @param PublicStatusPageModel $model 
     * @return array|bool 
     */
    public static function update($id, PublicStatusPageModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/psps/$id", 'PATCH', $model->asArray());
        }
        else {
            return false;
        }
    }
}