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
        $install->execSql("CREATE DATABASE IF NOT EXISTS hotel DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;");
        if (!$install->dbExists()) {
            $install->createTableGuests();
            $install->createTableRooms();
            $install->createTableReservations();
        }
        
        
        

        $router = new Router();
        $router->handle();
        
        ?>
    </body>
</html>


