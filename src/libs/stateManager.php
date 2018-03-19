<?php
class StateManager
{
    private $history;
    public function __construct()
    {
        $history = array();
    }

    public function getHistory()
    {
        return $this->history;
    }

    public function update($newState)
    {
        foreach ($newState as $key => $value) {
            switch ($key) {
                case "url":
                    Navigator::goto($value);
                    break;
                case "session":
                    foreach ($value as $sessionName => $sessionValue) {
                        switch ($sessionName) {
                            case "admin":
                                Session::setAdmin($sessionValue);
                                break;
                            default:
                                throw new Exception("Unknown session name : " . $sessionName);
                        }
                    }
                    break;
                default:
                    throw new Exception("Unknown state key: " . $key);
            }
        }
        array_push($this->history, $newState);
    }
}