UptimeRobot API
===============

Provides a wrapper to UptimeRobot API calls and abstracts away authentication.

<p align="center">
    <a href="LICENSE"><img src="https://img.shields.io/badge/license-BSD%203--Clause-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
</p>

## Installation

Installation is easy with [Composer](https://getcomposer.org/):

```bash
$ composer require worlddevs/uptime-robot-api
```

or add it by hand to your `composer.json` file.

## Upgrading

Breaking changes may occur between major releases: [semantic versioning](https://semver.org/).
We would provide upgrade guides for major version upgrades, when that happens.

## Usage

You'll need the endpoint and API key.  Currently UptimeRobot API version 3 (v3) is suppported.

Get started with a simple example:

```php
use worlddevs\Environment;
use worlddevs\UserService;

Environment::configure($endpoint, $api_key);

$result = UserService::retrieve();

print_r($result);
```

```bash
Array
(
    [email] => <<redacted>>
    [fullName] => <<redacted>>
    [monitorsCount] => 15
    [monitorLimit] => 100
    [smsCredits] => 5
    [activeSubscription] => Array
        (
            [plan] => <<redacted>>
            [monitorLimit] => <<redacted>>
            [expirationDate] => <<redacted>>
            [status] => active
        )

)
```