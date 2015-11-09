<?php
class PullToDB {

    public function DB_Connect($server, $port,$dbname,$user, $password){

        $this->server   = $server;
        $this->port     = $port;
        $this->dbname   = $dbname;
        $this->user     = $user;
        $this->password = $password;

        $this->conn_string =
        "host=".$this->server.
        " port=". $this->port .
        " dbname=". $this->dbname .
        " user=". $this->user .
        " password=".$this->password;

        $this->conn = pg_connect($this->conn_string);

        return $this->conn;

    }
}
