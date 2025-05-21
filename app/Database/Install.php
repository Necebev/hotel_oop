<?php

namespace App\Database;

use App\Views\Display;
use Exception;

class Install extends Database
{

    function dbExists(): bool
    {
        try {
            $conn = mysqli_connect(self::DEFAULT_CONFIG['host'], self::DEFAULT_CONFIG['user'], self::DEFAULT_CONFIG['password']);
            if (!$conn) {
                throw new Exception('Kapcsolódási hiba: ' . mysqli_connect_error());
            }
            

            $query = sprintf("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '%s';", self::DEFAULT_CONFIG['database']);
            $result = $conn->query($query);

            if (!$result) {
                throw new Exception('Lekérdezési hiba: ' . $conn->error);
            }
            $exists = $result->num_rows > 0;

            return $exists;

        }
        catch (Exception $e) {
            Display::message($e->getMessage(), 'error');
            error_log($e->getMessage());

            return false;
        }
        finally {
            // Ensure the database connection is always closed
            $conn?->close();
        }

    }

    

    public function createTable(string $tableName, string $tableBody, string $dbName): bool
    {
        try {
            $sql = "
                CREATE TABLE `$dbName`.`$tableName`
                ($tableBody)
                ENGINE = InnoDB
                DEFAULT CHARACTER SET = utf8
                COLLATE = utf8_hungarian_ci;
            ";
            return (bool) $this->execSql($sql);

        } catch (Exception $e) {
            Display::message($e->getMessage(), 'error');
            error_log($e->getMessage());
            return false;
        }
    }

    function createTableRooms($dbName = self::DEFAULT_CONFIG['database']): bool
    {
        $tableBody = "
            id INT NOT NULL AUTO_INCREMENT,
            floor INT NOT NULL,
            room_number INT NOT NULL,
            space INT NOT NULL,
            price INT NOT NULL,
            note VARCHAR(255),
            PRIMARY KEY (`id`)
        ";

        return $this->createTable('rooms', $tableBody, $dbName);
    }
    function createTableGuests($dbName = self::DEFAULT_CONFIG['database']): bool
    {
        $tableBody = "
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            age INT NOT NULL,
            PRIMARY KEY (`id`)
        ";
        return $this->createTable('guests', $tableBody, $dbName);
    }

    function createTableReservations($dbName = self::DEFAULT_CONFIG['database']): bool
    {
        $tableBody = "
            id INT NOT NULL AUTO_INCREMENT,
            room_id INT NOT NULL,
            guest_id INT NOT NULL,
            days INT NOT NULL,
            date DATE NOT NULL,
            PRIMARY KEY (`id`),
            FOREIGN KEY (room_id) REFERENCES rooms(ID),
            FOREIGN KEY (guest_id) REFERENCES guests(ID)
        ";

        return $this->createTable("reservations", $tableBody, $dbName);
    }
}