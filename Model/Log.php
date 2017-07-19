<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class Log
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var int
     */
    protected $datetime;
    /**
     * @var int
     */
    protected $duration;
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null)
    {
        $this->type = $type;
        return $this;
    }
    /**
     * @return int
     */
    public function getDatetime()
    {
        return $this->datetime;
    }
    /**
     * @param int $datetime
     *
     * @return self
     */
    public function setDatetime($datetime = null)
    {
        $this->datetime = $datetime;
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
}