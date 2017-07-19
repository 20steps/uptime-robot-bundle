<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class Account
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var int
     */
    protected $monitorLimit;
    /**
     * @var int
     */
    protected $monitorInterval;
    /**
     * @var int
     */
    protected $upMonitors;
    /**
     * @var int
     */
    protected $downMonitors;
    /**
     * @var int
     */
    protected $pausedMonitors;
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param string $id
     *
     * @return self
     */
    public function setId($id = null)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null)
    {
        $this->email = $email;
        return $this;
    }
    /**
     * @return int
     */
    public function getMonitorLimit()
    {
        return $this->monitorLimit;
    }
    /**
     * @param int $monitorLimit
     *
     * @return self
     */
    public function setMonitorLimit($monitorLimit = null)
    {
        $this->monitorLimit = $monitorLimit;
        return $this;
    }
    /**
     * @return int
     */
    public function getMonitorInterval()
    {
        return $this->monitorInterval;
    }
    /**
     * @param int $monitorInterval
     *
     * @return self
     */
    public function setMonitorInterval($monitorInterval = null)
    {
        $this->monitorInterval = $monitorInterval;
        return $this;
    }
    /**
     * @return int
     */
    public function getUpMonitors()
    {
        return $this->upMonitors;
    }
    /**
     * @param int $upMonitors
     *
     * @return self
     */
    public function setUpMonitors($upMonitors = null)
    {
        $this->upMonitors = $upMonitors;
        return $this;
    }
    /**
     * @return int
     */
    public function getDownMonitors()
    {
        return $this->downMonitors;
    }
    /**
     * @param int $downMonitors
     *
     * @return self
     */
    public function setDownMonitors($downMonitors = null)
    {
        $this->downMonitors = $downMonitors;
        return $this;
    }
    /**
     * @return int
     */
    public function getPausedMonitors()
    {
        return $this->pausedMonitors;
    }
    /**
     * @param int $pausedMonitors
     *
     * @return self
     */
    public function setPausedMonitors($pausedMonitors = null)
    {
        $this->pausedMonitors = $pausedMonitors;
        return $this;
    }
}