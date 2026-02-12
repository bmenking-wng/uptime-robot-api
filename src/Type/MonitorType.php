<?php

namespace worlddevs\uptimerobot\Type;

enum MonitorType: string {
    case PAUSED = "PAUSED";
    case STARTED = "STARTED";
    case UP = "UP";
    case LOOKS_DOWN = "LOOKS_DOWN";
    case DOWN = "DOWN";
}