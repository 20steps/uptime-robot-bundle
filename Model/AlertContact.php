<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class AlertContact
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $friendlyName;
    /**
     * @var int
     */
    protected $type;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $value;
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
}