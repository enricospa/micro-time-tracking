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
   composer require enricospa\microtime-tracker
   ```

### Usage

Code example:
   ```php
   use Enricospa\MicrotimeTracker\Tracker;

   $tracker = new Tracker();

   // Some code to measure here

   $tracker->snap('Some code executed!');

   echo $tracker->reportHtml();
   ```

_More examples coming..._

## License

See the [LICENSE](LICENSE.txt) file for license rights and limitations (MIT).
