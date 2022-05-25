<?php

class Db {

    private array $dbSettings;
    private string $dbDriver;
    private string $dbHost;
    private string $dbName;
    private string $dbUser;
    private string $dbPass;


    public function __construct() {

        $this->dbSettings =
            parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/secure/settings.ini',true);
        $this->dbDriver = $this->dbSettings['database']['driver'];
        $this->dbHost = $this->dbSettings['database']['host'];
        $this->dbName = $this->dbSettings['database']['name'];
        $this->dbUser = $this->dbSettings['database']['username'];
        $this->dbPass = $this->dbSettings['database']['password'];

    }

    protected function connect(): PDO
    {
        $dsn = $this->dbDriver . ":host=" . $this->dbHost . ";dbname=" . $this->dbName . ";charset=utf8mb4";
        $pdo = new PDO($dsn, $this->dbUser, $this->dbPass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
        return $pdo;

    }

}
