<?php

namespace worlddevs\uptimerobot\Type;

enum PSPAnnouncementType: string {
    case STATUS_OFFLINE = "OFFLINE";
    case STATUS_PENDING = "PENDING";
    case STATUS_PUBLISHED = "PUBLISHED";
    case STATUS_ARCHIVED = "ARCHIVED";    
}