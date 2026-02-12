<?php

namespace worlddevs\uptimerobot\Model;

class MaintenanceWindowModel extends Model {
    protected Array $required = ['id', 'userId', 'name', 'interval', 'date', 'time', 'duration', 'autoAddMonitors', 'days', 'status', 'created'];
    protected Array $changeable = ['name', 'interval', 'date', 'time', 'duration', 'days', 'monitorIds'];
}