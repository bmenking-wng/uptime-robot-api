<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\MaintenanceWindowModel;

class MaintaintenceWindowService extends Service {
    /**
     * 
     * @param mixed $cursor 
     * @return array 
     */
    public static function search($cursor = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/maintenance-windows", 'GET', $query);
    }

    /**
     * Create a maintenance window
     * @param MaintenanceWindowModel $model 
     * @return bool 
     */
    public static function create(MaintenanceWindowModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/maintenance-windows", 'POST', [], $model->asArray());
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
        return self::makeCall("/v3/maintenance-windows/$id");
    }

    /**
     * 
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/maintenance-windows/$id", 'DELETE');
    }

    /**
     * Update a maintenance window
     * @param mixed $id 
     * @param MaintenanceWindowModel $model 
     * @return bool 
     */
    public static function update($id, MaintenanceWindowModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/maintenance-windows/$id", 'PATCH', [], $model->asArray());
        }
        else {
            return false;
        }
    }
}