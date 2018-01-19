<?php
require_once 'Database.php';

class Settings{

  private $db;
  private $table = 'settings';

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getSettings()
  {
    $sql = "SELECT * FROM $this->table WHERE id = 1";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function insertSettings($logo, $facebook, $twitter, $copyrightinfo)
  {
    $sql = "INSERT INTO $this->table (logo, facebook, twitter, copyrightinfo) VALUES (:logo, :facebook, :twitter, :copyrightinfo)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':logo', $logo);
    $stmt->bindParam(':facebook', $facebook);
    $stmt->bindParam(':twitter', $twitter);
    $stmt->bindParam(':copyrightinfo', $copyrightinfo);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updateSettings($logo, $facebook, $twitter, $copyrightinfo)
  {
    $sql = "UPDATE $this->table SET logo = :logo, facebook = :facebook, twitter = :twitter, copyrightinfo = :copyrightinfo WHERE id = 1";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':logo', $logo);
    $stmt->bindParam(':facebook', $facebook);
    $stmt->bindParam(':twitter', $twitter);
    $stmt->bindParam(':copyrightinfo', $copyrightinfo);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }


}
