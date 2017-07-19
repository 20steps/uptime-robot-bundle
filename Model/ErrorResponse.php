<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class ErrorResponse
{
    /**
     * @var string
     */
    protected $stat;
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $message;
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
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * @param string $message
     *
     * @return self
     */
    public function setMessage($message = null)
    {
        $this->message = $message;
        return $this;
    }
}