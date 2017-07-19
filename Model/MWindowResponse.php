<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class MWindowResponse
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
     * @var MWindow
     */
    protected $mwindow;
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
     * @return MWindow
     */
    public function getMwindow()
    {
        return $this->mwindow;
    }
    /**
     * @param MWindow $mwindow
     *
     * @return self
     */
    public function setMwindow(MWindow $mwindow = null)
    {
        $this->mwindow = $mwindow;
        return $this;
    }
}