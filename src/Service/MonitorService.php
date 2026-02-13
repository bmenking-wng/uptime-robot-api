<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\MonitorModel;
use worlddevs\uptimerobot\Type\MonitorType;
use worlddevs\uptimerobot\Type\TimeframeType;

class MonitorService extends Service {
    /**
     * List all monitors in a user's account. Values can be paginated with the cursor parameter. Optionally filter by tags, URL, name, status, groupId, or limit. All filters use AND logic when combined.
     * @param int $limit 
     * @param null|MonitorType $status 
     * @param null|int $groupId 
     * @param null|string $name 
     * @param null|string $url 
     * @param null|string $tags 
     * @param null|int $cursor 
     * @return array 
     */
    public static function search($limit = 50, ?MonitorType $status = null, ?int $groupId = null, ?String $name = null, ?String $url = null, ?String $tags = null, ?int $cursor = null): array {
        $query = ['limit'=>$limit];

        if( $status != null ) $query[] = ['status'=>$status];
        if( $groupId != null ) $query[] = ['groupId'=>$groupId];
        if( $name != null ) $query[] = ['name'=>$name];
        if( $url != null ) $query[] = ['url'=>$url];
        if( $tags != null ) $query[] = ['tags'=>$tags];
        if( $cursor != null ) $query[] = ['cursor'=>$cursor];

        return self::makeCall("/v3/monitors", 'GET', $query);
    }

    /**
     * Get a monitor by ID.
     * @param mixed $id 
     * @return array 
     */
    public static function retrieve($id): array {
        return self::makeCall("/v3/monitors/$id");
    }

    /**
     * Delete a monitor.
     * @param mixed $id 
     * @return array 
     */
    public static function delete($id): array {
        return self::makeCall("/v3/monitors/$id", 'DELETE');
    }

    /**
     * Update a monitor.
     * @param mixed $id 
     * @param MonitorModel $model 
     * @return array|bool 
     */
    public static function update($id, MonitorModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/monitors/$id", 'PATCH', [], $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Create a monitor.
     * @param MonitorModel $model 
     * @return array|bool 
     */
    public static function create(MonitorModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/monitors", 'POST', [], $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Pauses a single monitor by ID. The monitor will stop being checked until it is resumed. This operation is idempotent - pausing an already paused monitor will return successfully.
     * @param mixed $id 
     * @return array 
     */
    public static function pause($id): array {
        return self::makeCall("/v3/monitors/$id/pause", 'POST');
    }

    /** 
     * Starts a paused monitor by ID. The monitor will resume being checked. This operation is idempotent - starting an already active monitor will return successfully.
     * 
     * @param mixed $id 
     * @return array 
     */
    public static function start(int $id): array {
        return self::makeCall("/v3/monitors/$id/start", 'POST');
    }

    /**
     * Resets stats for a monitor. This includes the stats for incidents and alerts.
     * 
     * @param mixed $id 
     * @return array 
     */
    public static function reset($id): array {
        return self::makeCall("/v3/monitors/$id/reset", 'POST');
    }

    /**
     * Returns aggregated uptime statistics across all monitors for the specified timeframe, including a logs array of incident entries.
     * 
     * @param TimeframeType $timeFrame 
     * @param int $logLimit 
     * @param mixed $start 
     * @param mixed $end 
     * @return array
     */
    public static function uptimeStats(TimeframeType $timeFrame, $logLimit = 50, $start = null, $end = null) {
        $query = [
            'timeFrame'=>$timeFrame,
            'logLimit'=>$logLimit
        ];

        if( $start != null ) $query[] = ['start'=>$start];
        if( $end != null ) $query[] = ['end'=>$end];

        return self::makeCall("/v3/monitors/uptime-stats", 'GET', $query);
    }

    /**
     * Returns uptime statistics for a specific monitor within a configurable date range. Defaults to the last 24 hours. Maximum range is 90 days.
     * 
     * @param int $id 
     * @param null|string $from 
     * @param null|string $to 
     * @return array 
     */
    public static function uptime(int $id, ?String $from = null, ?String $to = null): array {
        $query = [];
        if( $from != null ) $query[] = ['from'=>$from];
        if( $to != null ) $query[] = ['to'=>$to];

        return self::makeCall("/v3/monitors/$id/stats/uptime", 'GET', $query);
    }
}