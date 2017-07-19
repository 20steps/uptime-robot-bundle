<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class GetAlertContactsResponse
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
     * @var AlertContact[]
     */
    protected $alertContacts;
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
     * @return AlertContact[]
     */
    public function getAlertContacts()
    {
        return $this->alertContacts;
    }
    /**
     * @param AlertContact[] $alertContacts
     *
     * @return self
     */
    public function setAlertContacts(array $alertContacts = null)
    {
        $this->alertContacts = $alertContacts;
        return $this;
    }
}