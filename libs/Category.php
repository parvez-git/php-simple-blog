<?php
require_once 'Database.php';

class Category{

  private $db;
  private $table = 'category';

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getCategory()
  {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }

  public function getCategoryById($id)
  {
    $sql = "SELECT * FROM $this->table WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function insertCategory($name)
  {
    $sql = "INSERT INTO $this->table (name) VALUES (:name)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':name', $name);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updateCategory($name, $id)
  {
    $sql = "UPDATE $this->table SET name = :name WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function deleteCategory($id)
  {
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

}
