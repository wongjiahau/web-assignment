<?php
class Model
{
    function __construct()
    {
        $this->db = new Database();
    }

    function beginTransaction() {
        $this->db->beginTransaction();
    }

    function rollBack() {
        $this->db->rollBack();
    }

    public function getLastInsertId()
    {
        return $this->db->lastInsertId();
    }


    function queryDb($query, $paramMap = array())
    {
        // Tips: sth means Statement-Handler
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute($paramMap);
        return $sth->fetchAll();
    }
}