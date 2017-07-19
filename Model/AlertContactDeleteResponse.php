<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class AlertContactDeleteResponse
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
     * @var AlertContact
     */
    protected $alertContact;
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
     * @return AlertContact
     */
    public function getAlertContact()
    {
        return $this->alertContact;
    }
    /**
     * @param AlertContact $alertContact
     *
     * @return self
     */
    public function setAlertContact(AlertContact $alertContact = null)
    {
        $this->alertContact = $alertContact;
        return $this;
    }
}