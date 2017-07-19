<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class MWindow
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $user;
    /**
     * @var int
     */
    protected $type;
    /**
     * @var string
     */
    protected $friendlyName;
    /**
     * @var int
     */
    protected $startTime;
    /**
     * @var int
     */
    protected $duration;
    /**
     * @var string
     */
    protected $value;
    /**
     * @var int
     */
    protected $status;
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id = null)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @param int $user
     *
     * @return self
     */
    public function setUser($user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param int $type
     *
     * @return self
     */
    public function setType($type = null)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return string
     */
    public function getFriendlyName()
    {
        return $this->friendlyName;
    }
    /**
     * @param string $friendlyName
     *
     * @return self
     */
    public function setFriendlyName($friendlyName = null)
    {
        $this->friendlyName = $friendlyName;
        return $this;
    }
    /**
     * @return int
     */
    public function getStartTime()
    {
        return $this->startTime;
    }
    /**
     * @param int $startTime
     *
     * @return self
     */
    public function setStartTime($startTime = null)
    {
        $this->startTime = $startTime;
        return $this;
    }
    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * @param int $duration
     *
     * @return self
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;
        return $this;
    }
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
    /**
     * @param string $value
     *
     * @return self
     */
    public function setValue($value = null)
    {
        $this->value = $value;
        return $this;
    }
    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param int $status
     *
     * @return self
     */
    public function setStatus($status = null)
    {
        $this->status = $status;
        return $this;
    }
}