<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class AccountDetailsResponse
{
    /**
     * @var string
     */
    protected $stat;
    /**
     * @var Account
     */
    protected $account;
    /**
     * @var Error
     */
    protected $error;
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
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }
    /**
     * @param Account $account
     *
     * @return self
     */
    public function setAccount(Account $account = null)
    {
        $this->account = $account;
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
}