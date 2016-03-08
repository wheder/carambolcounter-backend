<?php

class DBSingleton {

    private static $conn = null;
    
    public function getDbConnection($db_init)
    {
        if (null == self::$conn) {
            if (is_array($db_init)) {
                try {
                    self::$conn = new PDO("$db_init[DBTYPE]:host=$db_init[DBHOSTNAME];dbname=$db_init[DBNAME]", "$db_init[DBUSER]", "$db_init[DBPASS]");
                    self::$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                } catch (PDOException $e) {
                    echo json_encode(Array('error' => $e->getMessage()));
                }
            } else {
                throw new Exception("Parameter was not an array!");
            }
        }
        return self::$conn;
            
    }
}

