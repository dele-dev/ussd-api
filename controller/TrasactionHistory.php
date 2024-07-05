<?php
include ($dataLink == "single") ? './model/TrasactionHistory.php':'../model/TrasactionHistory.php';


function saveTrasactionHistory ($data){ 
        $trasactionHistory =  new TrasactionHistory(); 
        if($trasactionHistory->saveTransactionHistory ($data["phonenumber"],$data["Operator"],$data["service"],$data["type"],$data["amount"])){
                return true;
        }else{
                return false;
        }     
}

function getTransactionHistory ($phonenumber,$limit){
         $trasactionHistory =  new TrasactionHistory();
        return $trasactionHistory->getTransactionHistory ($phonenumber,$limit);     
}

