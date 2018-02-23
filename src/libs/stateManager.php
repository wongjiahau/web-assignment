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
                    Session::set($value['key'], $value['value']);
                    break;
                default:
                    throw new Exception("Unknown state key");
            }
        }
        array_push($this->history, $newState);
    }
}