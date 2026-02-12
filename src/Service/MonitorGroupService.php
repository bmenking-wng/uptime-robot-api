<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\MonitorGroupModel;

class MonitorGroupService extends Service {
    /**
     * List all monitor groups in a user's account. Values can be paginated with the cursor parameter.
     * @param mixed $cursor 
     * @return array 
     */
    public static function search($cursor = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/monitor-groups", 'GET', $query);
    }

    /**
     * Create a monitor group.
     * @param MonitorGroupModel $model 
     * @return array|bool 
     */
    public static function create(MonitorGroupModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/monitor-groups", 'POST', $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Get monitor group details by ID
     * @param mixed $id 
     * @return array 
     */
    public static function retrieve($id): array {
        return self::makeCall("/v3/monitor-groups/$id");
    }

    /**
     * Delete a monitor group. Monitors in the deleted group will be moved to the specified group or to the default group (ID: 0).
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/monitor-groups/$id", 'DELETE');
    }

    /**
     * Update a monitor group (name)
     * @param string $id 
     * @param MonitorGroupModel $model 
     * @return array|bool 
     */
    public static function update(String $id, MonitorGroupModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/monitor-groups/$id", 'PATCH', $model->asArray());
        }
        else {
            return false;
        }
    }
}