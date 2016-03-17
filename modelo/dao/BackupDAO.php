<?php


class BackupDAO {
    private $dbName = 'ges_productivitymanager';
            function BackupTablas ($ruta, $tabla, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("SELECT * into outfile ? from areas");
           $sentencia->bindParam(1, $ruta);
//            $sentencia->bindParam(2, $tabla);
          
            $sentencia->execute();
            $mensaje = "BackUp Generado con Éxito";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        $cnn = NULL;
        return $mensaje;
    }
    function listarTablas(PDO $cnn){
        
        try {
            
            $query = $cnn->prepare("SHOW TABLES");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }  
    }
   public function backupTables(PDO $cnn, $tables = '*', $outputDir = '../BackUp') {
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

      $sql = 'CREATE DATABASE IF NOT EXISTS ' . $this->dbName  . ";\n\n";
      $sql .= 'USE ' . $this->dbName  . ";\n\n";
$fields = $cnn->query("select count(*) as cant from information_schema.tables where table_schema = 'ges_productivitymanager'");
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
//          $row[$j] = addslashes($row[$j]);
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

  protected function saveFile(&$sql, $outputDir = '../BackUp') {
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
