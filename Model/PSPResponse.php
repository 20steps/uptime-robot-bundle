<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class PSPResponse
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
     * @var PSP
     */
    protected $psp;
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
     * @return PSP
     */
    public function getPsp()
    {
        return $this->psp;
    }
    /**
     * @param PSP $psp
     *
     * @return self
     */
    public function setPsp(PSP $psp = null)
    {
        $this->psp = $psp;
        return $this;
    }
}