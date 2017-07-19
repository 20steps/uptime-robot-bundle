<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class PSP
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
     * @var int
     */
    protected $monitors;
    /**
     * @var int
     */
    protected $sort;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $standardUrl;
    /**
     * @var string
     */
    protected $customUrl;
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
     * @return int
     */
    public function getMonitors()
    {
        return $this->monitors;
    }
    /**
     * @param int $monitors
     *
     * @return self
     */
    public function setMonitors($monitors = null)
    {
        $this->monitors = $monitors;
        return $this;
    }
    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }
    /**
     * @param int $sort
     *
     * @return self
     */
    public function setSort($sort = null)
    {
        $this->sort = $sort;
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
    public function getStandardUrl()
    {
        return $this->standardUrl;
    }
    /**
     * @param string $standardUrl
     *
     * @return self
     */
    public function setStandardUrl($standardUrl = null)
    {
        $this->standardUrl = $standardUrl;
        return $this;
    }
    /**
     * @return string
     */
    public function getCustomUrl()
    {
        return $this->customUrl;
    }
    /**
     * @param string $customUrl
     *
     * @return self
     */
    public function setCustomUrl($customUrl = null)
    {
        $this->customUrl = $customUrl;
        return $this;
    }
}