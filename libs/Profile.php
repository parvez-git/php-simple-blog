<?php
require_once 'Database.php';

class Profile{

  private $db;
  private $table = 'profile';

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getProfileByUserId($user_id)
  {
    $sql = "SELECT * FROM $this->table WHERE user_id = :user_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function insertProfile($image, $dob, $gender, $profession, $city, $address, $phone, $user_id)
  {
    $profession = implode(',',$profession);

    $sql = "INSERT INTO $this->table (image, dob, gender, profession, city, address, phone, user_id) VALUES (:image, :dob, :gender, :profession, :city, :address, :phone, :user_id)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':profession', $profession);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updateProfile($image, $dob, $gender, $profession, $city, $address, $phone, $user_id)
  {
    $profession = implode(',',$profession);

    $sql = "UPDATE $this->table SET image = :image, dob = :dob, gender = :gender, profession = :profession, city = :city, address = :address, phone = :phone WHERE user_id = :user_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':profession', $profession);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }


}
