<<<<<<< HEAD:dbconnection.php
<?php
class Db
{
    private $connection;

    public function __construct() {
        $dbhost = "localhost";
        $dbName = "web_db";
        $userName = "root";
        $userPassword = "";

        $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbName", $userName, $userPassword,
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function findAllUsers() {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    /* array */

    public function findAllConversionsByUserId($userId) {
        $sql = "SELECT * FROM `conversions` WHERE userId=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addNewConversion($userId, $input, $output, $parseType) {
        $sql = "INSERT INTO `conversions` VALUES(id,?,?,?,?,current_timestamp)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId, $input, $output, $parseType]);
    }


    public function findById($userId) {
        $sql = "SELECT * FROM `users` WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
        return $stmt->fetchAll();
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM `users` WHERE username=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username]);
        return $stmt->fetchAll();
    }

    public function register($username, $email, $password) {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES(?,?,?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $email, $password]);
    }

    public function checkLoginData($username, $password) {
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $password]);
        return $stmt;
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM `users` WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
    }

    public function changePassword($userId, $password) {
        $sql = "UPDATE user SET password=? WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$password, $userId]);
    }

    public function checkUserExists($username, $email) {
        $sql = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $email]);
        return $stmt;
    }

    public function deleteAllConversionsByUserId($userId){
        $sql = "DELETE FROM `conversions` WHERE userId=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
    }
}

=======
<?php
class Db
{
    private $connection;

    public function __construct() {
        $dbhost = "localhost";
        $dbName = "web_db";
        $userName = "root";
        $userPassword = "";

        $this->connection = new PDO("mysql:host=$dbhost;dbname=$dbName", $userName, $userPassword,
            [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function findAllUsers() {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->getConnection()->query($sql);
        return $stmt->fetchAll();
    }

    /* array */

    public function findAllConversionsByUserId($userId) {
        $sql = "SELECT * FROM `conversions` WHERE userId=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
        return $stmt->fetchAll();
    }

    public function addNewConversion($userId, $input, $output, $parseType) {
        $sql = "INSERT INTO `conversions` VALUES(id,?,?,?,?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId, $input, $output, $parseType]);
    }


    public function findById($userId) {
        $sql = "SELECT * FROM `users` WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
        return $stmt->fetchAll();
    }

    public function findByUsername($username) {
        $sql = "SELECT * FROM `users` WHERE username=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username]);
        return $stmt->fetchAll();
    }

    public function register($username, $email, $password) {
        $sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES(?,?,?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $email, $password]);
    }

    public function checkLoginData($username, $password) {
        $sql = "SELECT * FROM users WHERE username=? AND password=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $password]);
        return $stmt;
    }

    public function deleteUser($userId) {
        $sql = "DELETE FROM `users` WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
    }

    public function changePassword($userId, $password) {
        $sql = "UPDATE user SET password=? WHERE id=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$password, $userId]);
    }

    public function checkUserExists($username, $email) {
        $sql = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$username, $email]);
        return $stmt;
    }

    public function deleteAllConversionsByUserId($userId){
        $sql = "DELETE FROM `conversions` WHERE userId=?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt -> execute([$userId]);
    }
}
>>>>>>> bf985c2483e17f63d34feb2d6528927c99caad1e:vesi/WEB/dbconnection.php
?>