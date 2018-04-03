<?php
class LoginModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run($id, $password)
    {
        $sth = $this->db->prepare("
            select password_hash from admin_data
            where admin_id = :admin_id
        ");

        $sth->execute(array(
            ':admin_id' => $id
        ));

        $result = $sth->fetchAll();
        $passwordHash = $result[0]["password_hash"];

        if (password_verify($password, $passwordHash)) {
            return array(
                'url' => 'retrieveMovie',
                'session' => array(
                    'admin' => $id
                )
            );
        } else {
            return array(
                'url' => 'login?error=1'
            );
        }
    }
}
