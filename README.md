# 20steps/uptime-robot-bundle (twentystepsCommonsUptimeRobotBundle)

About
-----

The 20steps UptimeRobot Bundle contains a service-oriented client for [**UptimeRobot**][2] API v2.0.

Use the bundle in scenarios where you want to automatically create monitors, alert contacts etc. at UptimeRobot.com for your given application or services or as part of your deployment process to automatically manage maintenance windows.

The Bundle is licensed under the [**LGPL license version 3.0**][4].

Installation
------------

Prerequisites: 
* Install [**Composer**][1], the dependency manager used by modern PHP applications.
* Setup your Symfony 3 based application
* Use PHP >= 7.0 as a runtime

1. Add the bundle to your composer.json and download a matching version by calling

```bash
composer require 20steps/commons-uptime-robot-bundle
```

2. Configure the API key of your account at UptimeRobot.com in your config.yml
```bash
twentysteps_commons_uptime_robot:
    api_key: "Your API Key"
```


Usage
-----

The following code shows how to create a monitor with the client.

```
<?php
    

use twentysteps\Commons\UptimeRobotBundle\API;
use twentysteps\Commons\UptimeRobotBundle\Model;
    
class MyService {
    
    /**
     * @var UptimeRobotAPI
     */
    private $uptimeRobotAPI;
	    
    /**
     * inject dependency to uptimeRobotAPI via your services.yml
     * the uptimeRobotAPI is a service itself with the id "twentysteps_commons.uptime_robot.api"
     */
    public function __construct(UptimeRobotAPI $uptimeRobotAPI) {
        $this->uptimeRobotAPI = $uptimeRobotAPI;
    }
    
    /**
     * create a monitor
     * @return \Psr\Http\Message\ResponseInterface|Error|Monitor
     */
    public function createMonitorForMyResource() {
        $parameters = [
            'friendly_name' => 'My Monitor,
            'url' => 'https://my-host.com/my-path'
        ];
        $response = $this->uptimeRobotAPI->monitor()->create($parameters);
        if ($response instanceof MonitorResponse) {
            /**
             * @var $response MonitorResponse
             */
            if ($response->getStat()=='ok') {
                return $response->getMonitor();
            } else {
                return $response->getError();
            }
        }
        return $response;
    }
}
```

The bundle provides some useful commands below the twentysteps:commons:uptime-robot namespace.

Eg. to list all monitors and their stati simply call

```
bin/console twentysteps:commons:uptime-robot:monitor:list
```

Hints
-----

* In case your application uses multiple accounts at UptimeRobot you can dynamically change
the api key as follows


```
<?php
    

$this->uptimeRobotAPI->setApiKey($myApiKey);

```

* Cp. section "parameters" of [**UptimeRobot API Documentation**][7] for an explanation of parameters.
* The UptimeRobot API has been enhanced by some extra utility methods such as api->monitor()->findByUrl(..), api->monitor->createOrUpdate(..), api->monitor->pauseByUrl(), api->monitor->resumeByUrl() etc.

Authors
-------

* Helmut Hoffer von Ankershoffen <hhva@20steps.de>

Sponsored by
------------

[**20steps - Digital Full Service Boutique**][3]

[1]:  https://getcomposer.org/
[2]:  https://uptimerobot.com/
[3]:  https://20steps.de
[4]:  http://www.gnu.org/licenses/lgpl-3.0.html
[5]:  https://github.com/janephp/openapi
[6]:  https://swagger.io/specification/
[7]:  https://uptimerobot.com/api
