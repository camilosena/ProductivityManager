<?php


class BackupDAO {
    private $dbName = 'productivitymanager';
    function BackupTablas ($table, PDO $cnn){
       $valor ="";
  

       $valor .= 'DROP TABLE IF EXISTS ' .$table.';'."\r\n";
       $creartable = $cnn->query("SHOW CREATE TABLE ".$table);
       foreach ($creartable as $create){
           $valor .= $create['Create Table'];
           $valor .= ';'."\r\n";
       }
       $rows = $cnn->query('SELECT * FROM '.$table);
       if ($table == 'roles' || $table == 'permisosPorRol' || $table == 'usuarioPorProyecto') {
        $num = 2;}elseif($table == 'areas' || $table == 'indicativos'
               || $table == 'materiaPrimaPorProducto' || $table == 'materiaPrimaPorProyecto'
               || $table == 'procesos' || $table == 'productoPorProyecto' || $table == 'usuarios'){
       $num = 3;}elseif($table == 'personas'){
       $num = 11;}elseif($table == 'clientes' || $table == 'productos' || $table == 'procesosPorProyecto' ){
       $num = 6;}elseif($table == 'contactenos' ){
       $num = 9;}elseif($table == 'proyectos'){
       $num = 7;}elseif($table == 'estudioDeCostos' || $table == 'novedades'){
       $num = 10;}elseif($table == 'materiaprima' || $table == 'permisos' || $table == 'procesoPorProducto' ){
       $num = 4;}

           foreach ($rows as $row){
               $valor .=  'INSERT INTO '.$table.' VALUES (';
               for ($i = 0; $i <$num; $i++) {
                
                   if (isset($row[$i])) {
                    $valor .= '"' . $row[$i] . '"';
                    }
                    if (!isset($row[$i])) {
                      $valor .='""';  
                    }
                    if ($i <($num - 1)) {
                    $valor .= ',';
                    }
                    if($i >= ($num-1)) {
                    $valor .= ');';
                     $valor .="\r\n";
                    }                 
                }     
           }     
   return $this->saveTable($table, $valor); 
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
    
    function createTable($table, PDO $cnn){
         try {
            
            $query = $cnn->prepare("SHOW CREATE TABLE ?");
            $query->bindParam(1, $table);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $ex) {
            echo 'Error' . $ex->getMessage();
        }
        
    }

    public function backupTables(PDO $cnn) {
   $tables = array('roles','areas','personas','clientes', 'indicativos','contactenos','proyectos','estudioDeCostos','productos','materiaprima','materiaPrimaPorProducto',
       'materiaPrimaPorProyecto','novedades','permisos','permisosPorRol','procesos','procesoPorProducto','procesosPorProyecto','productoPorProyecto',
       'usuarioPorProyecto', 'usuarios');
   $valor ="";
   $valor .= 'DROP DATABASE IF EXISTS '.$this->dbName.';'."\r\n";
   $valor .= 'CREATE DATABASE IF NOT EXISTS '.$this->dbName.';'."\r\n";
   $valor .='USE '.$this->dbName.';'."\r\n";
   
   foreach ($tables as $table){

       $valor .= 'DROP TABLE IF EXISTS ' .$table.';'."\r\n";
       $creartable = $cnn->query("SHOW CREATE TABLE ".$table);
       foreach ($creartable as $create){
           $valor .= $create['Create Table'];
           $valor .= ';'."\r\n";
       }

       $rows = $cnn->query('SELECT * FROM '.$table);
       if ($table == 'roles' || $table == 'permisosPorRol' || $table == 'usuarioPorProyecto') {
        $num = 2;}elseif($table == 'areas' || $table == 'indicativos'
               || $table == 'materiaPrimaPorProducto' || $table == 'materiaPrimaPorProyecto'
               || $table == 'procesos' || $table == 'productoPorProyecto' || $table == 'usuarios'){
       $num = 3;}elseif($table == 'personas'){
       $num = 11;}elseif($table == 'clientes' || $table == 'productos' || $table == 'procesosPorProyecto' ){
       $num = 6;}elseif($table == 'contactenos' ){
       $num = 9;}elseif($table == 'proyectos'){
       $num = 7;}elseif($table == 'estudioDeCostos' || $table == 'novedades'){
       $num = 10;}elseif($table == 'materiaprima' || $table == 'permisos' || $table == 'procesoPorProducto' ){
       $num = 4;}

           foreach ($rows as $row){
               $valor .=  'INSERT INTO '.$table.' VALUES (';
               for ($i = 0; $i <$num; $i++) {
                
                   if (isset($row[$i])) {
                    $valor .= '"' . $row[$i] . '"';
                    }
                    if (!isset($row[$i])) {
                      $valor .='""';  
                    }
                    if ($i <($num - 1)) {
                    $valor .= ',';
                    }
                    if($i >= ($num-1)) {
                    $valor .= ');';
                     $valor .="\r\n";
                    }                 
                }     
           }     
   }
   
   return $this->saveFile($valor);  
  }

  /* Save SQL to file @param string $sql */
protected function saveTable($table, $sql, $outputDir = '../BackUp') {
    if (!$sql)
      return false;

    try {
      $handle = fopen($outputDir . '/tb-backup-' . $table . '-' . date("Ymd-His", time()) . '.sql', 'w+');
      fwrite($handle, $sql);
      fclose($handle);
    } catch (Exception $e) {
      var_dump($e->getMessage());
      return false;
    }
    return true;
  }
  protected function saveFile($sql, $outputDir = '../BackUp') {
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
