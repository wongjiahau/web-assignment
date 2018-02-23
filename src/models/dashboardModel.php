<?php
class dashboardModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrInsert()
    {
        // Tips: sth means Statement-Handler
        $sth = $this->db->prepare('insert into data(value) values(:x)');
        $sth->execute(array(':x' => $_POST['text']));
        echo json_encode(array('id' => $this->db->lastInsertId(), 'value' => $_POST['text']));
    }

    function xhrGetListings()
    {
        $sth = $this->db->prepare('select * from data');
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        echo json_encode($sth->fetchAll());
    }

    function xhrDeleteListing()
    {
        $id = $_POST['id'];
        $sth = $this->db->prepare('delete from data where id=:id');
        $sth->execute(array(':id' => $id));
    }
}
