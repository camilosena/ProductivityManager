<?php


class BackupDAO {
    
    function BackupTablas ($ruta, $tabla, PDO $cnn){
        
         try {
            $sentencia = $cnn->prepare("SELECT * into outfile ? from $tabla");
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
    function Backup_Database( PDO $cnn) {
    
   $cnn->query("SET NAMES utf8");
   $result = $cnn->query("SHOW TABLES");
   $tablas = 1;
   while ($row = $result->fetch()){
       $tables []=$row['Tables_in_productivitymanager'];
       
   }
   print_r($tables) ."<br>";
   $fields = $cnn->query("select count(*) as cant from information_schema.tables where table_schema = 'productivitymanager'");
    $cantidad = $fields->fetch();
   $num_fields = $cantidad['cant'];
   foreach ($result as $table) {

       echo $table;
       for ($i = 0; $i<2; $i++){
       $result1 = $cnn->query('SELECT * FROM '.$table);
       $return .= 'DROP TABLE IF EXIST '.$table.';';
       $_row2 = $cnn->query('SHOW CREATE TABLE '. $table);
       $row2 = $_row2->fetch();
       $return .="\n\n".$row2[1]."\n\n";
//           while ($row = $result1->fetch()){
//               $return .= 'INSERT INTO '.$table.' VALUES(';
//                for($j=0; $j=2; $j++){
////                    
//                    if (isset($row[$j])) {
//                        $return .='"'.$row[$j].'"';
//                    }else
//                    {
//                        $return .='""';
//                    }
//                    if ($j<($num_fields-1)) {
//                        $return .=',';
//                    }
//                    $return .=");\n";
//                }
//          }
           $return .="\n\n";
       }
       
       echo "<pre>";
       print_r($return);
       echo '</pre>';
       exit;
       
       $folder = "../../BackUp/";
       $date = date('d-m-Y', time());
       $filename = $folder."_".$date;
       fwrite($handle, $return);
       fclose($handle);
       
       $fp = fopen($filename.'.sql','w');
       fwrite($fp, $return);
       fclose($fp);
   }
    }
    
}    
