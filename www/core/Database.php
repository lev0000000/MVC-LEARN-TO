<?php

namespace PHPFramework;

class Database {

  protected \PDO $connection;

  protected \PDOStatement $statement;

  public function __construct(){
    $dsn = "mysql:host=" . DB_SETTINGS['host'] . 
        ";dbname=" . DB_SETTINGS["database"] .
        ";charset=". DB_SETTINGS['charset'];

    try{
        $this->connection = new \PDO($dsn, 
            DB_SETTINGS['username'], 
            DB_SETTINGS['password'], 
            DB_SETTINGS['options']);
    }catch(\PDOException $e){
      error_log("[" . date("Y-m-d H:i:s") . "] DB Error:
        {$e->getMessage()}" . PHP_EOL, 3, ERROR_LOGS);
        abort('DB error connection', 500);
    }
  }

  public function query(string $query, array $params = []) 
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);
    return $this;
  }


  public function get(): array|false {
    return $this->statement->fetchAll();
  }

  public function getAssoc($key = 'id') :array{
    $data = [];
    while($row = $this->statement->fetch()){
        $data[$row[$key]] = $row;
    }

    return $data;
  }

  public function getOne():mixed{
    return $this->statement->fetch();
  }

  public function getColumn():mixed
  {
    return $this->statement->fetchColumn();
  }

  public function findAll($table):array|false{
    $this->query("select * from {$table}");
    return $this->statement->fetchAll();
  }

  public function findOne($table, $value, $key = "id") :array|false{
    $this->query("select * from {$table} where $key= ? LIMIT 1", [$value]);
    return $this->statement->fetch();
  }

  public function findOrFailed($table, $value, $key = "id") :array|false{
    $res = $this->findOne($table, $value, $key);
    if(!$res){
        abort();
    }
    return $res;
  }

  public function getInsertId():false|string
  {
    return $this->connection->lastInsertId();
  }

  public function rowCount():int{
    return $this->statement->rowCount();
  }

  public function commit():bool{
    return $this->connection->commit();
  }

  public function rollback():bool{
    return $this->connection->rollback();
  }
  
  public function beginTransaction():bool
  {
    return $this->connection->beginTransaction();
  }


}