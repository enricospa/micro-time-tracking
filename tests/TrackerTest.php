<?php declare(strict_types=1);

namespace Enricospa\MicrotimeTracker\Tests;

use Enricospa\MicrotimeTracker\TimestampHolder;
use PHPUnit\Framework\TestCase;
use Enricospa\MicrotimeTracker\Tracker;

final class TrackerTest extends TestCase
{
    // TODO: complete the test
    public function testTimeCanBeTracked()
    {
        // $this->expectOutputString('');

        // Init the tracker
        $tracker = new Tracker(new TimestampHolder);

        // First snap starts the tracker
        $tracker->snap('Start tracking');

        // Sleep for a while
        usleep(2000000);

        $tracker->snap('Slept for a while');

        // Sleep for a while
        usleep(20000);

        $tracker->snap('Slept again');

        echo $tracker->reportConsole();
    }
}