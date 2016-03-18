<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BackUp
 *
 * @author user
 */
class BackUp {
    
    //put your code here
    var $host = 'localhost';
  var $username = 'ges_gerente';
  var $passwd = 'Prueba1';
  var $dbName = 'ges_productivitymanager';
  var $charset = '';

  /* Constructor initializes database */

  function Backup_Database($host, $username, $passwd, $dbName, $charset = 'utf8') {
    $this->host = $host;
    $this->username = $username;
    $this->passwd = $passwd;
    $this->dbName = $dbName;
    $this->charset = $charset;
    $this->initializeDatabase();
  }

  protected function initializeDatabase() {
    $conn = @mysql_connect($this->host, $this->username, $this->passwd); // Ik Added @ to Hide PDO Error Message
    mysql_select_db($this->dbName, $conn);
    if (!mysql_set_charset($this->charset, $conn)) {
      mysql_query('SET NAMES ' . $this->charset);
    }
  }

  /* Backup the whole database or just some tables Use '*' for whole database or 'table1 table2 table3...' @param string $tables  */

  public function backupTables(PDO $cnn, $tables = '*', $outputDir = '.') {
    try {
      /* Tables to export  */
      if ($tables == '*') {
        $tables = array();
        $result = $cnn->query('SHOW TABLES');
        while ($row = $result->fetch()) {
          $tables[] = $row[0];
        }
      } else {
        $tables = is_array($tables) ? $tables : explode(',', $tables);
      }

      $sql = 'CREATE DATABASE IF NOT EXISTS ' . $this->dbName . ";\n\n";
      $sql .= 'USE ' . $this->dbName . ";\n\n";
$fields = $cnn->query("select count(*) as cant from information_schema.tables where table_schema = 'productivitymanager'");
    $cantidad = $fields->fetch();
   $num_fields = $cantidad['cant'];
  /* Iterate tables */
  foreach ($tables as $table) {
    echo "Backing up " . $table . " table...";

    $result1 = $cnn->query('SELECT * FROM ' . $table);

    $sql .= 'DROP TABLE IF EXISTS ' . $table . ';';
    $_row2 = $cnn->query('SHOW CREATE TABLE '. $table);
       $row2 = $_row2->fetch();
    $sql.= "\n\n" . $row2[1] . ";\n\n";

    for ($i = 0; $i < $num_fields; $i++) {
      while ($row = $result1->fetch()) {
        $sql .= 'INSERT INTO ' . $table . ' VALUES(';
        for ($j = 0; $j < $num_fields; $j++) {
          $row[$j] = addslashes($row[$j]);
          // $row[$j] = ereg_replace("\n", "\\n", $row[$j]);
          if (isset($row[$j])) {
            $sql .= '"' . $row[$j] . '"';
          } else {
            $sql.= '""';
          }
          if ($j < ($num_fields - 1)) {
            $sql .= ',';
          }
        }
        $sql.= ");\n";
      }
    }
    $sql.="\n\n\n";
    echo " OK <br/><br/>" . "";
  }
} catch (Exception $e) {
  var_dump($e->getMessage());
  return false;
 }

    return $this->saveFile($sql, $outputDir);
  }

  /* Save SQL to file @param string $sql */

  protected function saveFile(&$sql, $outputDir = '.') {
    if (!$sql)
      return false;

    try {
      $handle = fopen($outputDir . '/db-backup-' . $this->dbName . '-' . date("Ymd-His", time()) . '.sql', 'w+');
      fwrite($handle, $sql);
      fclose($handle);
    } catch (Exception $e) {
      var_dump($e->getMessage());
      return false;
    }
    return true;
  }

}
