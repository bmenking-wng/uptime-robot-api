<?php

namespace worlddevs\uptimerobot\Model;

class Model {
    protected Array $attributes = [];
    protected Array $restricted = [];
    protected Array $required = [];
    protected Array $changeable = [];

    public function __set(string $name, mixed $value): void {
        if( !in_array($name, $this->restricted) ) {
            $this->attributes[$name] = $value;
        }
    }

    public function __get(string $name): mixed {
        return $this->attributes[$name] ?? null;
    }

    public function __isset(string $name): bool {
        return isset($this->attributes[$name]);
    }

    public function __unset(string $name): void {
        if( isset($this->attributes[$name]) ) {
            unset($this->attributes[$name]);
        }
    }

    public function getRestricted(): array {
        return $this->restricted;
    }

    public function getRequired(): array {
        return $this->required;
    }

    public function canCreate(): bool {
        return count(array_diff_key($this->required, $this->attributes)) == 0;
    }

    public function canUpdate(): bool {
        return count(array_diff_key($this->changeable, $this->attributes)) == 0;
    }

    public function asArray(): array {
        return $this->attributes;
    }
}