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
        return $this->array_keys_exist($this->required, $this->attributes);
    }

    public function canUpdate(): bool {
        return $this->array_keys_exist($this->changeable, $this->attributes);
    }

    public function asArray(): array {
        return $this->attributes;
    }

    /**
     * Using the values from $required as key names, make sure $haystack has all those values as keys.
     * @param array $required 
     * @param array $haystack 
     * @return bool 
     */
    private function array_keys_exist(Array $required, Array $haystack): bool {
        foreach($required as $key) {
            if( !array_key_exists($key, $haystack) ) return false;
        }

        return true;
    }    
}