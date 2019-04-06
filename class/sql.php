<?php

class Sql extends PDO
{
    private $_conn;

    public function __construct()
    {

        $this->_conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
    }

    private function setParams($statement, $parameters = array())
    {
        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }
    private function setParam($statement, $key, $value)
    {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array())
    {
        $stmt = $this->_conn->prepare($rawQuery);
        $this->setParams($stmt, $params);
        $stmt->execute();
        return $stmt;

    }

    public function select($rawQuery, $params = array()): array
    {
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchall(PDO::FETCH_ASSOC);

    }
}
