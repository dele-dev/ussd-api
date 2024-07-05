<?php


class Activity  {

   
    
    public $conn;
    public $tableName;
    
    function __construct() {
    
        $db = new DatabaseConnection ();
        $this->conn =  $db->conn;
        $this->tableName = "activity_tbl";
    
      }

        
        
        
    public function saveActivity ($phonenumber,$options_selected) {
        
            $insert =  "INSERT INTO `activity_tbl`(`id`, `phonenumber`, `options_selected`, `date_at`, `status`, `deleted`)
                        VALUES (null,'$phonenumber','$options_selected',now(),'0','0')";

            $result = $this->conn->query($insert);

                if($result){
                            return true;
                }else{
                            return false;
                        }

                        $this->conn->close();
    }





    public function getActivity ($user_id) {

        $sql = "select * from awards_tbl where  profile_id =  '".$user_id."' and deleted = 0";

        $result = $this->conn->query($sql);
        
        if($result->num_rows ){
            return  $data = mysqli_fetch_all($result);;
        }else{
            return [];
        }   
        
}


public function updateActivity ($address,$telephone,$postal,$gender,$dob,$Award_id) {

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