<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class Error
{
    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $message;
    /**
     * @var string
     */
    protected $parameterName;
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
    /**
     * @return string
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }
    /**
     * @param string $parameterName
     *
     * @return self
     */
    public function setParameterName($parameterName = null)
    {
        $this->parameterName = $parameterName;
        return $this;
    }
}