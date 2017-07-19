<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class GetMonitorsResponse
{
    /**
     * @var string
     */
    protected $stat;
    /**
     * @var Error
     */
    protected $error;
    /**
     * @var Pagination
     */
    protected $pagination;
    /**
     * @var Monitor[]
     */
    protected $monitors;
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
    /**
     * @return Pagination
     */
    public function getPagination()
    {
        return $this->pagination;
    }
    /**
     * @param Pagination $pagination
     *
     * @return self
     */
    public function setPagination(Pagination $pagination = null)
    {
        $this->pagination = $pagination;
        return $this;
    }
    /**
     * @return Monitor[]
     */
    public function getMonitors()
    {
        return $this->monitors;
    }
    /**
     * @param Monitor[] $monitors
     *
     * @return self
     */
    public function setMonitors(array $monitors = null)
    {
        $this->monitors = $monitors;
        return $this;
    }
}