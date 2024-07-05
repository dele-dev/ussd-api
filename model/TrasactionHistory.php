<?php


class TrasactionHistory  {

   
    
    public $conn;
    public $tableName;
    
    function __construct() {
    
        $db = new DatabaseConnection ();
        $this->conn =  $db->conn;
        $this->tableName = "trasaction_history_tbl";
    
      }

        
        
        
    public function saveTransactionHistory ($phonenumber,$Operator,$service,$type,$amount) {
        
            $insert =  "INSERT INTO `trasaction_history_tbl`(`id`, `phonenumber`,
             `Operator`, `service`, `type`, `amount`, `date`, `status`, `deleted`) 
                        VALUES (null,'$phonenumber','$Operator','$service','$type','$amount',now(),'0','0')";

            $result = $this->conn->query($insert);

                if($result){
                            return true;
                }else{
                            return false;
                        }

                        $this->conn->close();
    }





    public function getTransactionHistory ($phonenumber,$limit) {

        $sql = "select * from trasaction_history_tbl where  phonenumber =  '".$phonenumber."' and deleted = 0 order by id desc limit ".$limit;

        $result = $this->conn->query($sql);
        
        if($result->num_rows ){
            return  $data = mysqli_fetch_all($result);;
        }else{
            return [];
        }   
        
}


public function updateTransactionHistory ($address,$telephone,$postal,$gender,$dob,$Award_id) {

    $insert =  "UPDATE `profile` SET address='$address', telephone = '$telephone' , 
    postal = '$postal' , gender = '$gender', dob = '$dob' ";

    $result = $this->conn->query($insert);

        if($result){
                    return true;
        }else{
                    return false;
                }

                $this->conn->close();
}  




}

?>