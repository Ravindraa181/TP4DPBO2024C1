<?php

class DB
{
    private $db_hostname;
    private $db_username;
    private $db_password;
    private $db_name;
    private $db_link;
    private $result;

    function __construct($db_hostname, $db_username, $db_password, $db_name)
    {
        $this->db_hostname = $db_hostname;
        $this->db_username = $db_username;
        $this->db_password = $db_password;
        $this->db_name = $db_name;
    }

    function open()
    {
        $this->db_link = mysqli_connect($this->db_hostname, $this->db_username, $this->db_password, $this->db_name);
    }

    function execute($query)
    {
        $this->result = mysqli_query($this->db_link, $query);
        return $this->result;
    }

    function getResult()
    {
        return mysqli_fetch_array($this->result);
    }

    function close()
    {
        mysqli_close($this->db_link);
    }
}