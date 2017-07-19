<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class MonitorResponse
{
    /**
     * @var string
     */
    protected $stat;
    /**
     * @var Monitor
     */
    protected $monitor;
    /**
     * @var Error
     */
    protected $error;
    /**
     * @return string
     */
    public function getStat()
    {
        return $this->stat;
    }
    /**
     * @param string $stat
     *
     * @return self
     */
    public function setStat($stat = null)
    {
        $this->stat = $stat;
        return $this;
    }
    /**
     * @return Monitor
     */
    public function getMonitor()
    {
        return $this->monitor;
    }
    /**
     * @param Monitor $monitor
     *
     * @return self
     */
    public function setMonitor(Monitor $monitor = null)
    {
        $this->monitor = $monitor;
        return $this;
    }
    /**
     * @return Error
     */
    public function getError()
    {
        return $this->error;
    }
    /**
     * @param Error $error
     *
     * @return self
     */
    public function setError(Error $error = null)
    {
        $this->error = $error;
        return $this;
    }
}