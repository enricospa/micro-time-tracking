<?php

namespace Enricospa\MicrotimeTracker;

use ArrayAccess;
use Iterator;
use UnexpectedValueException;

class TimestampHolder implements ArrayAccess, Iterator
{
    /**
     * Cursor position
     *
     * @var integer
     */
    private $position = 0;

    /**
     * Timestamps container
     *
     * @var array
     */
    public $container = [];

    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * @throws UnexpectedValueException
     */
    public function offsetSet($offset, $value) : void
    {
        // Value must be an instance of Timestamp
        if (!$value instanceof Timestamp) {
            throw new UnexpectedValueException('Trying to set a value that is not a Timestamp instance');
        }

        // Update calculated times values on object
        $value = $this->updateCalculatedTimes($value);

        // If the offset is not specified get the first next
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Update Timestamp object with calculated times like time passed from
     * previous snap
     *
     * @param Timestamp $value
     * @return Timestamp
     */
    private function updateCalculatedTimes(Timestamp $value) : Timestamp
    {
        // Time from start
        $time_from_start = 0;
        if ($this->offsetExists(0)) {
            $start_timestamp = $this->offsetGet(0)->getTimestamp();
            $time_from_start = $value->getTimestamp() - $start_timestamp;
        }
        $value->setTimeFromStart($time_from_start);

        // Time from previous snap
        $time_from_previous = 0;
        $previous = array_key_last($this->container);
        if ($previous !== null) {
            $previous_timestamp = $this->offsetGet($previous)->getTimestamp();
            $time_from_previous = $value->getTimestamp() - $previous_timestamp;
        }
        $value->setTimeFromPrevious($time_from_previous);

        return $value;
    }

    public function offsetExists($offset) : bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet($offset) : Timestamp|null
    {
        return $this->offsetExists($offset) ? $this->container[$offset] : null;
    }

    public function offsetUnset($offset) : void
    {
        unset($this->container[$offset]);
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->container[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->container[$this->position]);
    }
}