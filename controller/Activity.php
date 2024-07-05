<?php
include ($dataLink == "single") ? './model/Activity.php':'../model/Activity.php';


function saveActivity ($data){ 
        $activity =  new Activity(); 
        if($activity->saveActivity ($data["phonenumber"],$data["options_selected"])){
                return true;
        }else{
                return false;
        }     
}

function getActivity ($user_id){
         $activity =  new Activity();
        return $activity->getActivity ($user_id);     
}

