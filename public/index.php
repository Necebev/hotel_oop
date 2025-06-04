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
            (1, 'Yaminah Salman', 32),
            (2, 'Mashal Khalid', 24),
            (3, 'Noreen Sawaya', 27),
            (4, 'Mahammed Amini', 45),
            (5, 'Hanif Arafat', 50),
            (6, 'Ziyad Shakir', 19),
            (7, 'Furat Akbar', 46),
            (8, 'Uvuvwevwevwe Onyetenyevwe Ugwemuhwem Osas', 28),
            (9, 'Kis Abadul', 23);
            ");

            $install->execSql("
                INSERT INTO reservations (id, room_id, guest_id, days, date) VALUES
                (1, 1, 1, 3, '2023-10-01'),
                (2, 2, 2, 5, '2023-10-02'),
                (3, 3, 3, 2, '2023-10-03'),
                (4, 4, 4, 4, '2023-10-04'),
                (5, 5, 5, 1, '2023-10-05'),
                (6, 6, 6, 7, '2023-10-06');");
        }
        
        
        
        $router = new Router();
        $router->handle();
        
        ?>
    </body>
</html>


