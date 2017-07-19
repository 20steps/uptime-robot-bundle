<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class AlertContactArray
{
    /**
     * @var AlertContact[]
     */
    protected $alertcontact;
    /**
     * @return AlertContact[]
     */
    public function getAlertcontact()
    {
        return $this->alertcontact;
    }
    /**
     * @param AlertContact[] $alertcontact
     *
     * @return self
     */
    public function setAlertcontact(array $alertcontact = null)
    {
        $this->alertcontact = $alertcontact;
        return $this;
    }
}