<?php

namespace Enricospa\MicrotimeTracker;

use Console_Table;
use DateTime;

class Tracker
{
    /**
     * Timestamps for the snaps
     *
     * @var TimestampHolder
     */
    private $snaps;

    /**
     * Empty timestamp holder instance
     *
     * @var TimestampHolder
     */
    private $holder;

    /**
     * Init the tracker
     *
     * @param TimestampHolder $holder
     */
    public function __construct(TimestampHolder $holder)
    {
        // Init the tracker
        $this->holder = $holder;
        $this->reset();
    }

    /**
     * Reset the tracker
     *
     * @return void
     */
    public function reset() : void
    {
        $this->snaps = $this->holder;
    }

    /**
     * Take a snapshot of the current timestamp
     *
     * @param string $description
     * @return void
     */
    public function snap($description = '') : void
    {
        $this->snaps[] = (new Timestamp())->setDescription($description);
    }

    /**
     * Report time snaps to console format
     *
     * @return string
     */
    public function reportConsole() : string
    {
        $table = new Console_Table();
        $table->setHeaders(
            ['Snap', 'Total Time', 'Interval', 'Description']
        );

        foreach ($this->snaps as $index => $snap) {
            $table->addRow([
                $index,
                $this->formatTime($snap->getTimeFromStart(), true),
                $this->formatTime($snap->getTimeFromPrevious(), true),
                $snap->getDescription()
            ]);
        }

        return $table->getTable();
    }

    /**
     * Display time in human readable format
     *
     * @param float $microseconds
     * @param boolean $show_um
     * @return string
     */
    private function formatTime($microseconds, $show_um = false) : string
    {
        $micro = sprintf("%06d", ($microseconds - floor($microseconds)) * 1000000);
        $d = new DateTime(date('H:i:s.'.$micro, $microseconds));

        $date = explode(':', $d->format("H:i:s:u"));

        $time = [
            'hours' => $date[0],
            'minutes' => $date[1],
            'seconds' => $date[2],
            'microseconds' => $date[3],
        ];

        $um = 's';
        $format = '%1$03u'.($show_um ? ' [%5$s]' : '');
        if ($time['minutes'] > 0) {
            $format = '%2$02u.'.$format;
        }
        else {
            $format = '%2$u.'.$format;
        }
        if ($time['minutes'] > 0) {
            $um = 'm';
            if ($time['hours'] > 0) {
                $format = '%3$02u:'.$format;
            }
            else {
                $format = '%3$u.'.$format;
            }
        }
        if ($time['hours'] > 0) {
            $um = 'h';
            $format = '%4$u:'.$format;
        }

        $time = sprintf($format, $time['microseconds'], $time['seconds'], $time['minutes'], $time['hours'], $um);

        return (floatval($time) == 0) ? '0' : rtrim($time, '0');
    }
}