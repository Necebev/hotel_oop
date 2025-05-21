<!DOCTYPE html>
<html lang="en">
    <script async data-id="five-server" src="http://localhost:5500/fiveserver.js"></script>
    <body>
        <?php
        include __DIR__ . '/../app/Database/Database.php';
        include __DIR__ . '/../vendor/autoload.php';
        session_start();
        
        ini_set('error_log', 'error_log.log');

        

        use App\Routing\Router;
        use App\Database\Install;
        $install = new Install(["host" => "localhost", "user" => "root", "password" => "", "database" => "mysql"]);
        
        if (!$install->dbExists()) {
            $install->execSql("CREATE DATABASE IF NOT EXISTS hotel DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;");
            $install->createTableGuests();
            $install->createTableRooms();
            $install->createTableReservations();
            $install->execSql("use hotel;");
            $install->execSql("
                INSERT INTO rooms (id, floor, room_number, space, price, note) VALUES
                (1, 1, 12, 4, 15000, 'megjegyzes1'),
                (2, 1, 15, 2, 12000, 'megjegyzes2'),
                (3, 2, 3, 6, 24000, 'megjegyzes3'),
                (4, 3, 5, 2, 16000, 'megjegyzes4'),
                (5, 4, 20, 6, 30000, 'megjegyzes5'),
                (6, 2, 13, 4, 20000, 'megjegyzes6');
            ");
            $install->execSql("
            INSERT INTO guests (id, name, age) VALUES
            (1, 'Clara Nabaggala', 32),
            (2, 'Ssali Kyaligonza', 24),
            (3, 'Mbabazi Cristal', 27),
            (4, 'Isabel Orishaba', 45),
            (5, 'Esther Nalweyiso', 50),
            (6, 'Maria Nanyombi', 19),
            (7, 'Willis Ssettende', 46),
            (8, 'Uvuvwevwevwe Onyetenyevwe Ugwemuhwem Osas', 28),
            (9, 'Kis Abadul', 23);
            ");
        }
        
        
        

        $router = new Router();
        $router->handle();
        
        ?>
    </body>
</html>


