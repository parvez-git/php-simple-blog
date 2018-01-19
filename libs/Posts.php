<?php
require_once 'Database.php';

class Posts{

  private $db;
  private $table = 'posts';
  private $table_users = 'users';

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getPosts()
  {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function getPostByUserId($userid)
  {
    $sql = "SELECT * FROM $this->table WHERE user_id = :user_id ORDER BY id DESC";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':user_id', $userid);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function countPostByUserId($userid)
  {
    $sql = "SELECT count('user_id') as useridcount FROM $this->table WHERE user_id = :user_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':user_id', $userid);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }

  public function getPostById($id)
  {
    $sql = "SELECT * FROM $this->table WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function insertPost($title, $content, $user_id, $category_id, $image)
  {
    $sql = "INSERT INTO $this->table (title, content, user_id, category_id, image) VALUES (:title, :content, :user_id, :category_id, :image)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':user_id',  $user_id);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':image', $image);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updatePost($title, $content, $category_id, $image, $id)
  {
    $sql = "UPDATE $this->table SET title = :title, content = :content, category_id = :category_id, image = :image WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function deletePost($id)
  {
    $sql = "DELETE FROM $this->table WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

}
