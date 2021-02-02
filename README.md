# Microtime Tracker
A PHP micro library for time tracking.


## About

Have you ever find yourself using PHP [`microtime`](https://www.php.net/microtime)
function for timing script execution?

`Microtime Tracker` is microtime, with superpowers :muscle:

## Getting Started

To use this library in your project simply require it with Composer.

### Installation

Install using Composer
   ```sh
   composer require enricospa/microtime-tracker
   ```

### Usage

Code example:
   ```php
   use Enricospa\MicrotimeTracker\Tracker;
   use Enricospa\MicrotimeTracker\TimestampHolder;

   // Init the tracker
   $tracker = new Tracker(new TimestampHolder);

   // First snap starts the tracker
   $tracker->snap('Start tracking');

   // Sleep for a while
   usleep(2000000);

   $tracker->snap('Slept for a while');

   echo "<pre>";
   echo $tracker->reportConsole();
   echo "</pre>";
   ```

_More examples coming..._

## License

See the [LICENSE](LICENSE.txt) file for license rights and limitations (MIT).
