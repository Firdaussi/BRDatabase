<?php
// - CountAccess class ( http://coursesweb.net )
// stores and counts the number of accesses

class CountAccess {
  // define public properties for table name and its columns
  public $tb_name = 'image_downloads';
  public $tb_cols = array('urlf'=>'urlf', 'nrac'=>'nrac', 'dt'=>'dt');

  // protected property to store the connection to the MySQL server
  protected $conn;

  // Constructor
  public function __construct($server, $user, $pass, $db) {
    // create the connection to MySQL database (stores it in $conn property)
    $this->conn = new mysqli($server, $user, $pass, $db);
    if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error()); exit; }

    // check if table $tb_name exists in $db
    // if not exists, calls the setTable() method to create the table
    $Tables_in_db = 'Tables_in_'.$db;
    if($result=$this->conn->query("SHOW TABLES IN $db WHERE `$Tables_in_db` = '$this->tb_name'")) {
      if(mysqli_num_rows($result)<=0) {
        $this->setTable();
        $result->close();
      }
    }
  }

  // method used to create the table
  private function setTable() {
    // sql query for CREATE TABLE
    $sql = "CREATE TABLE `$this->tb_name` (
     `". $this->tb_cols['urlf']. "`  VARCHAR(88) PRIMARY KEY NOT NULL,
     `". $this->tb_cols['nrac']. "` INT(8) UNSIGNED DEFAULT 1,
     `". $this->tb_cols['dt']. "` TIMESTAMP
    ) CHARACTER SET utf8 COLLATE utf8_general_ci";

    // performs the $sql query on the server to create the table, on failure returns the error
    if (!$this->conn->query($sql) === TRUE) {
      echo 'Error create table: '. $this->conn->error;
    }
  }

  // method to insert / update the number of accesses of $urlf
  public function setAccess($urlf) {
    $urlf = $this->conn->real_escape_string($urlf);       // escape special characters for use in the SQL query

    // sql query for INSERT / UPDATE
    $sql = "INSERT INTO `". $this->tb_name. "` (`". $this->tb_cols['urlf']. "`) VALUES ('$urlf') ON DUPLICATE KEY UPDATE `". $this->tb_cols['nrac']. "`=`". $this->tb_cols['nrac']. "`+1";

    // performs the $sql query on the server to insert / update the values
    if (!$this->conn->query($sql) === TRUE) {
      echo 'Error: '. $this->conn->error;
    }
  }

  // method to select the number of accesses (and the date-time of the last accessing) of $urlf
  public function getAccess($urlf) {
    $urlf = $this->conn->real_escape_string($urlf);       // escape special characters for use in the SQL query

    // sql query for SELECT
    $sql = "SELECT `". $this->tb_cols['nrac']. "`, DATE_FORMAT(`". $this->tb_cols['dt']. "`, '%d-%m-%Y %H:%i') AS dt FROM `". $this->tb_name. "` WHERE `". $this->tb_cols['urlf']. "`='$urlf' LIMIT 1";

    // perform the query and store the results
    $result = $this->conn->query($sql);

    // if the $result contains at least one row
    if ($result->num_rows > 0) {
      // store the number of accesses and the date-time in a array
      while($row = $result->fetch_assoc()) {
        $re = 'Accesses: '. $row['nrac']. ', last: <i>'. $row['dt']. '</i>';
      }
    }
    else { $re = 'Accesses: 0, last: 0'; }

    // closes the statement, to free the memory
    $result->close();

    return $re;          // returns the string from $re
  }
}


      /* Using the CountAccess class  */

// sets data for connecting to mysql database (server_address, username, password and database_name)
$server = 'localhost';
$user = 'brdataba_log';
$pass = 'D813D!adem';
$db = 'brdataba_log';

// create the MySQL connection and a instance of CountAccess class
$objCA = new CountAccess($server, $user, $pass, $db);

// if there is $_GET['urlf']
if (isset($_GET['urlf'])) {
  $urlf = trim(strip_tags($_GET['urlf']));        // delete tags and white spaces

  // calls the setAccess() method to insert / update the number of accesses
  $objCA->setAccess($urlf);

  // Redirects the browser to the URL stored in $urlf
  header("Location: " . $urlf); exit;
}
?>