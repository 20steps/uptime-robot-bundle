<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class Monitor
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $friendlyName;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var int
     */
    protected $type;
    /**
     * @var string
     */
    protected $subType;
    /**
     * @var string
     */
    protected $keywordType;
    /**
     * @var string
     */
    protected $keywordValue;
    /**
     * @var string
     */
    protected $httpUsername;
    /**
     * @var string
     */
    protected $httpPassword;
    /**
     * @var string
     */
    protected $port;
    /**
     * @var int
     */
    protected $interval;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var int
     */
    protected $createDatetime;
    /**
     * @var int
     */
    protected $monitorGroup;
    /**
     * @var int
     */
    protected $isGroupMain;
    /**
     * @var Log[]
     */
    protected $logs;
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
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url = null)
    {
        $this->url = $url;
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
    public function getSubType()
    {
        return $this->subType;
    }
    /**
     * @param string $subType
     *
     * @return self
     */
    public function setSubType($subType = null)
    {
        $this->subType = $subType;
        return $this;
    }
    /**
     * @return string
     */
    public function getKeywordType()
    {
        return $this->keywordType;
    }
    /**
     * @param string $keywordType
     *
     * @return self
     */
    public function setKeywordType($keywordType = null)
    {
        $this->keywordType = $keywordType;
        return $this;
    }
    /**
     * @return string
     */
    public function getKeywordValue()
    {
        return $this->keywordValue;
    }
    /**
     * @param string $keywordValue
     *
     * @return self
     */
    public function setKeywordValue($keywordValue = null)
    {
        $this->keywordValue = $keywordValue;
        return $this;
    }
    /**
     * @return string
     */
    public function getHttpUsername()
    {
        return $this->httpUsername;
    }
    /**
     * @param string $httpUsername
     *
     * @return self
     */
    public function setHttpUsername($httpUsername = null)
    {
        $this->httpUsername = $httpUsername;
        return $this;
    }
    /**
     * @return string
     */
    public function getHttpPassword()
    {
        return $this->httpPassword;
    }
    /**
     * @param string $httpPassword
     *
     * @return self
     */
    public function setHttpPassword($httpPassword = null)
    {
        $this->httpPassword = $httpPassword;
        return $this;
    }
    /**
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }
    /**
     * @param string $port
     *
     * @return self
     */
    public function setPort($port = null)
    {
        $this->port = $port;
        return $this;
    }
    /**
     * @return int
     */
    public function getInterval()
    {
        return $this->interval;
    }
    /**
     * @param int $interval
     *
     * @return self
     */
    public function setInterval($interval = null)
    {
        $this->interval = $interval;
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
     * @return int
     */
    public function getCreateDatetime()
    {
        return $this->createDatetime;
    }
    /**
     * @param int $createDatetime
     *
     * @return self
     */
    public function setCreateDatetime($createDatetime = null)
    {
        $this->createDatetime = $createDatetime;
        return $this;
    }
    /**
     * @return int
     */
    public function getMonitorGroup()
    {
        return $this->monitorGroup;
    }
    /**
     * @param int $monitorGroup
     *
     * @return self
     */
    public function setMonitorGroup($monitorGroup = null)
    {
        $this->monitorGroup = $monitorGroup;
        return $this;
    }
    /**
     * @return int
     */
    public function getIsGroupMain()
    {
        return $this->isGroupMain;
    }
    /**
     * @param int $isGroupMain
     *
     * @return self
     */
    public function setIsGroupMain($isGroupMain = null)
    {
        $this->isGroupMain = $isGroupMain;
        return $this;
    }
    /**
     * @return Log[]
     */
    public function getLogs()
    {
        return $this->logs;
    }
    /**
     * @param Log[] $logs
     *
     * @return self
     */
    public function setLogs(array $logs = null)
    {
        $this->logs = $logs;
        return $this;
    }
}