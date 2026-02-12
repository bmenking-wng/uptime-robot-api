<?php

namespace worlddevs\uptimerobot\Type;

enum TimeframeType: string {
    case DAY = 'DAY';
    case WEEK = 'WEEK';
    case MONTH = 'MONTH';
    case DAYS_30 = 'DAYS_30';
    case YEAR = 'YEAR';
    case ALL = 'ALL';
    case CUSTOM = 'CUSTOM';
}