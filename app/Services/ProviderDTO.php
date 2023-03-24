<?php

namespace App\Services;

class ProviderDTO
{
    public string $name;

    public int $estimatedDuration;

    public int $level;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getEstimatedDuration(): int
    {
        return $this->estimatedDuration;
    }

    /**
     * @param int $estimatedDuration
     */
    public function setEstimatedDuration(int $estimatedDuration): void
    {
        $this->estimatedDuration = $estimatedDuration;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel(int $level): void
    {
        $this->level = $level;
    }

    public function toArray(): array
    {
        $ref = new \ReflectionClass($this);

        $result = [];

        foreach ($ref->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $result[$property->getName()] = $this->{$property->getName()};
        }

        return $result;
    }
}
