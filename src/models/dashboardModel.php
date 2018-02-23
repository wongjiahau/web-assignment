<?php
class dashboardModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    function xhrInsert()
    {
        $result = $this->queryDb(
            'insert into data(value) values(:x)',
            array(':x' => $_POST['text'])
        );
        echo json_encode(array('id' => $this->db->lastInsertId(), 'value' => $_POST['text']));
    }

    function xhrGetListings()
    {
        echo json_encode($this->queryDb('select * from data'));
    }

    function xhrDeleteListing()
    {
        $id = $_POST['id'];
        $sth = $this->db->prepare('delete from data where id=:id');
        $sth->execute(array(':id' => $id));
    }
}
