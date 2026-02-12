<?php

namespace worlddevs\uptimerobot\Service;

class IncidentService extends Service {
    /**
     * List all incidents in a user's account with optional filtering. Values can be paginated with the cursor parameter.
     * @param mixed $cursor 
     * @param mixed $monitor_id 
     * @param mixed $monitor_name 
     * @param mixed $started_after 
     * @param mixed $started_before 
     * @return array 
     */
    public static function search($cursor = null, $monitor_id = null, $monitor_name = null, $started_after = null, $started_before = null): array {
        $query = [];
        if( $cursor !== null ) $query[] = ['cursor'=>$cursor];
        if( $monitor_id !== null ) $query[] = ['monitor_id'=>$monitor_id];
        if( $monitor_name !== null ) $query[] = ['monitor_name'=>$monitor_name];
        if( $started_after !== null ) $query[] = ['started_after'=>$started_after];
        if( $started_before !== null ) $query[] = ['started_before'=>$started_before];

        return self::makeCall("/v3/incidents", 'GET', $query);
    }

    /**
     * Get incident details including root cause information
     * @param mixed $id 
     * @return array 
     */
    public static function retrieve($id): array {
        return self::makeCall("/v3/incidents/$id");
    }

    /**
     * Create a new comment on an incident
     * @param mixed $id 
     * @param mixed $comment 
     * @return array 
     */
    public static function createComment($id, $comment): array {
        $data = [
            'content'=>$comment
        ];

        return self::makeCall("/v3/incidents/$id/comments", 'POST', $data);
    }

    /**
     * Returns the activity log for an incident, including status updates, comments, and notifications. Sorted by date descending.
     * @param mixed $id 
     * @return array 
     */
    public static function activityLog($id): array {
        return self::makeCall("/v3/incidents/$id/activity-log");
    }

    /**
     * Returns all alerts that were sent for a specific incident, including recipient information and delivery status.
     * @param mixed $id 
     * @return array 
     */
    public static function sentAlerts($id): array {
        return self::makeCall("/v3/incidents/$id/alerts");
    }

    /**
     * Delete a comment from an incident
     * @param mixed $incident_id 
     * @param mixed $comment_id 
     * @return array 
     */
    public static function deleteComment($incident_id, $comment_id): array {
        return self::makeCall("/v3/incidents/$incident_id/comments/$comment_id", 'DELETE');
    }

    /**
     * Updates an existing comment on an incident
     * @param mixed $incident_id 
     * @param mixed $comment_id 
     * @param mixed $comment 
     * @return array 
     */
    public static function updateComment($incident_id, $comment_id, $comment): array {
        $data = [
            'content'=>$comment
        ];

        return self::makeCall("/v3/incidents/$incident_id/comments/$comment_id", 'PATCH', $data);
    }
}