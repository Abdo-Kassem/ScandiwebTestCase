<?php

namespace Applecation\Liberary\DBConnection;

use PDO;
use PDOException;

class DBConnection
{
    private static ?PDO $pdo = null;

    private function __construct() { }
    

    public final static function createPDO()
    {
        if(self::$pdo === null) {
            static::createConnection();
        }
        return self::$pdo;
    }

    protected static function createConnection()
    {
       
        try {
            self::$pdo = new PDO(DSN,USER_NAME,PASSWORD);
        }catch(PDOException $ex) {
            throw $ex;
        }
    }
    
}