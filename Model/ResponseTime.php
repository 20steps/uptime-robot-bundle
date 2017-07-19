<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class ResponseTime
{
    /**
     * @var string
     */
    protected $value;
    /**
     * @var string
     */
    protected $datetime;
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
     * @return string
     */
    public function getDatetime()
    {
        return $this->datetime;
    }
    /**
     * @param string $datetime
     *
     * @return self
     */
    public function setDatetime($datetime = null)
    {
        $this->datetime = $datetime;
        return $this;
    }
}