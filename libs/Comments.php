<?php
require_once 'Database.php';

class Comments{

  private $db;
  private $table = 'comments';

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getCommentsByPostId($post_id)
  {
    $sql = "SELECT * FROM $this->table WHERE post_id = :post_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':post_id', $post_id);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }


  public function insertComments($user_id, $post_id, $comment)
  {
    $sql = "INSERT INTO $this->table (user_id, post_id, comment) VALUES (:user_id, :post_id, :comment)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updateComments($user_id, $post_id, $comment)
  {
    $sql = "UPDATE $this->table SET comment = :comment WHERE user_id = :user_id AND post_id = :post_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':post_id', $post_id);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }


}
