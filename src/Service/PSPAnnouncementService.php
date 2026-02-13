<?php

namespace worlddevs\uptimerobot\Service;

use worlddevs\uptimerobot\Model\PSPAnnouncementModel;
use worlddevs\uptimerobot\Type\PSPAnnouncementType;

/**
 * 
 * @package worlddevs\uptimerobot\Service
 */
class PSPAnnouncementService extends Service {
    /**
     * List all announcements for a Public Status Page. Results are sorted by creation date (newest first) and can be filtered by status.
     * @param mixed $id 
     * @param null|worlddevs\uptimerobot\PSPAnnouncementType $status 
     * @param string $cursor 
     * @return array 
     */
    public static function search($id, ?PSPAnnouncementType $status = null, $cursor = ""): array {
        $query = [];
        if( $status !== null ) $query['status'] = $status;
        if( !empty($cursor) ) $query['cursor'] = $cursor;
        
        return self::makeCall("/v3/psps/$id/announcements", 'GET', $query);
    }
    
    /**
     * Create an Public status page announcement.
     * @param mixed $psp_id 
     * @param PSPAnnouncementModel $model 
     * @return array|bool 
     */
    public static function createAnnouncement($psp_id, PSPAnnouncementModel $model): array|bool {
        if( $model->canCreate() ) {
            return self::makeCall("/v3/psps/$psp_id/announcements", 'POST', [], $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Retrieve a single announcement for a Public Status Page
     * @param mixed $psp_id 
     * @param mixed $announcement_id 
     * @return array 
     */
    public static function retrieve($psp_id, $announcement_id): array {
        return self::makeCall("/v3/psps/$psp_id/annoucements/$announcement_id");
    }

    /**
     * Update a public status page announcement.
     * @param mixed $psp_id 
     * @param mixed $announcement_id 
     * @param PSPAnnouncementModel $model 
     * @return array|bool 
     */
    public static function updateAnnouncement($psp_id, $announcement_id, PSPAnnouncementModel $model): array|bool {
        if( $model->canUpdate() ) {
            return self::makeCall("/v3/psps/$psp_id/announcements/$announcement_id", 'PATCH', [], $model->asArray());
        }
        else {
            return false;
        }
    }

    /**
     * Pin an announcement to the Public Status Page. This operation is idempotent.
     * @param mixed $psp_id 
     * @param mixed $announcement_id 
     * @return array 
     */
    public static function pin($psp_id, $announcement_id): array {
        return self::makeCall("/v3/psps/$psp_id/announcements/$announcement_id/pin", 'POST');
    }

    /**
     * Unpin an announcement from the Public Status Page. This operation is idempotent.
     * @param mixed $psp_id 
     * @param mixed $announcement_id 
     * @return array 
     */
    public static function unpin($psp_id, $announcement_id): array {
        return self::makeCall("/v3/psps/$psp_id/announcements/$announcement_id/pin", 'POST');
    }    
}