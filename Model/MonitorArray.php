<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class MonitorArray
{
    /**
     * @var Monitor[]
     */
    protected $monitor;
    /**
     * @return Monitor[]
     */
    public function getMonitor()
    {
        return $this->monitor;
    }
    /**
     * @param Monitor[] $monitor
     *
     * @return self
     */
    public function setMonitor(array $monitor = null)
    {
        $this->monitor = $monitor;
        return $this;
    }
}