<?php

namespace twentysteps\Commons\UptimeRobotBundle\Model;

class Pagination
{
    /**
     * @var string
     */
    protected $offset;
    /**
     * @var string
     */
    protected $limit;
    /**
     * @var string
     */
    protected $total;
    /**
     * @return string
     */
    public function getOffset()
    {
        return $this->offset;
    }
    /**
     * @param string $offset
     *
     * @return self
     */
    public function setOffset($offset = null)
    {
        $this->offset = $offset;
        return $this;
    }
    /**
     * @return string
     */
    public function getLimit()
    {
        return $this->limit;
    }
    /**
     * @param string $limit
     *
     * @return self
     */
    public function setLimit($limit = null)
    {
        $this->limit = $limit;
        return $this;
    }
    /**
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }
    /**
     * @param string $total
     *
     * @return self
     */
    public function setTotal($total = null)
    {
        $this->total = $total;
        return $this;
    }
}