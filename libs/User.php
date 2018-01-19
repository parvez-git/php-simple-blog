<?php
require_once 'Database.php';

class User{

  private $db;
  private $table = 'users';
  private $role_table = 'roles';

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUsers()
  {
    $sql = "SELECT * FROM $this->table ORDER BY id DESC";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }

  public function getUserById($id)
  {
    $sql = "SELECT * FROM $this->table WHERE id = :id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }

  public function checkEmail($email)
  {
    $sql = "SELECT email FROM $this->table WHERE email = ?";
    $query = $this->db->conn->prepare( $sql );
    $query->bindParam(1, $email);
    $query->execute();

    return ($query->rowCount() > 0) ? $query : false;
  }


  public function insertUser($name, $username, $email, $password)
  {
    $sql = "INSERT INTO $this->table (name, username, email, password) VALUES (:name, :username, :email, :password)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', md5($password), PDO::PARAM_STR);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }


  public function loginUser($email, $password)
  {
    $sql = "SELECT * FROM $this->table WHERE email = ? AND password = ? LIMIT 1";
    $query = $this->db->conn->prepare($sql);
    $query->bindValue(1, $email);
    $query->bindValue(2, md5($password));
    $query->execute();

    return $query->fetch();
  }


  public function userRoleRelation()
  {
    $sql = "SELECT $this->table.id, $this->table.name, $this->role_table.name as rolename
            FROM $this->table
            LEFT JOIN $this->role_table ON $this->role_table.user_id = $this->table.id";

    $query = $this->db->conn->prepare($sql);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }


  public function userRoles()
  {
    $sql = "SELECT * FROM $this->role_table ORDER BY name ASC";
    $query = $this->db->conn->prepare($sql);
    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserRoleById($user_id)
  {
    $sql = "SELECT * FROM $this->role_table WHERE user_id = :user_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();

    $results = $stmt->fetch(PDO::FETCH_ASSOC);

    return $results ? $results : false;
  }

  public function insertUserRole($name, $user_id)
  {
    $sql = "INSERT INTO $this->role_table (name, user_id) VALUES (:name, :user_id)";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

  public function updateUserRole($name, $user_id)
  {
    $sql = "UPDATE $this->role_table SET name = :name WHERE user_id = :user_id";
    $stmt = $this->db->conn->prepare( $sql );
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt : false;
  }

}
