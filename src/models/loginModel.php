<?php
class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $sth = $this->db->prepare("
            select password_hash from admin_data
            where admin_id = :admin_id
        ");

        $sth->execute(array(
            ':admin_id' => $_POST['login']
        ));

        $result = $sth->fetchAll();
        $passwordHash = $result[0]["password_hash"];

        if (password_verify($_POST['password'], $passwordHash)) {
            Session::set('loggedIn', true);
            Navigator::goto('dashboard');
        } else {
            Navigator::goto('login');
        }
    }
}
