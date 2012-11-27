<?php
// Include the config variables
require_once 'includes/config.php';

/**
 * Basic database class
 */
class Database {

    /**
     * @var mysqli
     */
    private $_connection;

    /**
     * Create a new mysqli connection
     */
    public function __construct() {
        $this->_connection = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($this->_connection->connect_error) {
            die('Connect Error (' . $this->_connection->connect_errno . ') ' . $this->_connection->connect_error);
        }
    }

    public function GetConnection() {
        return $this->_connection;
    }

    /**
     * Close the mysqli connection
     */
    public function __destruct() {
        mysqli_close($this->_connection);
    }

    /**
     * Run an sql command
     *
     * @param $sql
     */
    public function Execute($sql) {
        return $this->_connection->query($sql);
    }

}