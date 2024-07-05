<?php


class Actions  {

   
    
    public $conn;
    
    function __construct() {
    
        $db = new DatabaseConnection ();
        $this->conn =  $db->conn;
    
      }

public function deleteIt ($item_to_be_selected,$table_to_use) {

    $delete =  "UPDATE ".$table_to_use."_tbl SET deleted = '1' where id = '".$item_to_be_selected."'  ";
    
    $result = $this->conn->query($delete);

        if($result){
                    return true;
        }else{
                    return false;
                }

                $this->conn->close();
}  




}

?>