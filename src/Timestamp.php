<?php

namespace Enricospa\MicrotimeTracker;

class Timestamp
{
    /**
     * Unix timestamp in micro seconds
     *
     * @var float
     */
    private $timestamp;

    /**
     * Description for the timestamp
     *
     * @var string
     */
    private $description;

    /**
     * Elapsed time from start
     *
     * @var float
     */
    private $time_from_start;

    /**
     * Elapsed time from previous timestamp
     *
     * @var float
     */
    private $time_from_previous;

    /**
     * Init the timestamp
     */
    public function __construct()
    {
        // Current time in seconds since the Unix epoch accurate to the nearest microsecond
        $microtime = microtime(true);

        $this->setTimestamp($microtime);
    }

    /**
     * Mutator for timestamp
     *
     * @param float $timestamp
     * @return self
     */
    private function setTimestamp(float $timestamp) : self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Accessor for timestamp
     *
     * @return float
     */
    public function getTimestamp() : float
    {
        return $this->timestamp;
    }

    /**
     * Mutator for description
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description) : self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Accessor for description
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Get elapsed time from start
     *
     * @return  float
     */
    public function getTimeFromStart() : float
    {
        return $this->time_from_start;
    }

    /**
     * Set elapsed time from start
     *
     * @param  float  $time_from_start  Elapsed time from start
     *
     * @return  self
     */
    public function setTimeFromStart(float $time_from_start) : self
    {
        $this->time_from_start = $time_from_start;

        return $this;
    }

    /**
     * Get elapsed time from previous timestamp
     *
     * @return  float
     */
    public function getTimeFromPrevious() : float
    {
        return $this->time_from_previous;
    }

    /**
     * Set elapsed time from previous timestamp
     *
     * @param  float  $time_from_previous  Elapsed time from previous timestamp
     *
     * @return  self
     */
    public function setTimeFromPrevious(float $time_from_previous) : self
    {
        $this->time_from_previous = $time_from_previous;

        return $this;
    }
}