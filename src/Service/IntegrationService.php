<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\IntegrationModel;

class IntegrationService extends Service {
    /**
     * List integrations
     * @param mixed $cursor 
     * @return array 
     */
    public static function search($cursor = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/integrations", 'GET', $query);
    }   

    /**
     * Create an Integration
     * @param IntegrationModel $model 
     * @return array|bool 
     */
    public static function create(IntegrationModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/integrations", 'POST', $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Get an integration details by ID
     * @param mixed $id 
     * @return array 
     */
    public static function retrieve($id): array {
        return self::makeCall("/v3/integrations/$id");
    }

    /**
     * Delete an integration
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/integrations/$id", 'DELETE');
    }

    /**
     * Update an Integration
     * @param mixed $id 
     * @param IntegrationModel $model 
     * @return array|bool 
     */
    public static function update($id, IntegrationModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/integrations/$id", 'PATCH', $model->asArray);
        }
        else {
            return false;
        }
    }
}