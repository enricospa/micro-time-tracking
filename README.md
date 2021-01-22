# Microtime Tracker
A PHP micro library for time tracking.


## About

Have you ever find yourself using PHP [`microtime`](https://www.php.net/microtime)
function for timing script execution?

`Microtime Tracker` is microtime, with superpowers :muscle:

## Getting Started

This is an example of how you may give instructions on setting up your project locally.
To get a local copy up and running follow these simple example steps.

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
