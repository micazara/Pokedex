<?php
class MySqlDatabase
{
    private $connection;
    public function __construct($servername, $username, $pw, $dbname)
    {
        $this->connection = mysqli_connect(
            $servername,
            $username,
            $pw,
            $dbname
        );

        if (!$this->connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function __destruct()
    {
        mysqli_close($this->connection);
    }

    // ejecuta consultas SQL que retornan un conjunto de resultados, como SELECT.
    public function query($sql)
    {
        Logger::info('Ejecutando query: ' . $sql);
        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_BOTH);
    }

    public function execute($sql)
    {
        Logger::info('Ejecutando query: ' . $sql);
        mysqli_query($this->connection, $sql);
    }

    
}
