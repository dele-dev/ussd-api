<?php
$dataLink = "double";
require_once("../controller/Central.php");
require_once("ussd_codes.php");

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

$decoded = json_decode($content, true); // CONVERT THE RAW CONTENT TO DECODED JSON


//USSD Parameters 
$userPhoneNumber = !isset($decoded["phonenumber"]) ?  "NO PHONE" : $decoded["phonenumber"] ;
$text = !isset($decoded["message"]) ?  "NO MESSAGE" : trim($decoded["message"]) ;
$processType = !isset($decoded["type"]) ?  "NO TYPE" : trim($decoded["type"]) ;


if(!isset($_SESSION["sessionId"])){
    $_SESSION["sessionId"] = session_create_id();
    $_SESSION["counter"] = 0;
    $_SESSION["last"] = array();
    $_SESSION["timer"] = time();

    $_SESSION["array789"] =  get789();
    $_SESSION["arrayAmount789"] =  amountPaid();
    $history = getTransactionHistory($userPhoneNumber,2);

    $array789 = $_SESSION["array789"];
    array_push($array789["2"]["2"]["paid"],$history);
    $_SESSION["array789"] = $array789;
}






/***
 * 
 * RESPONSE FUNCTION
 * this function takes 
 * 
 * @params $res
 * @params $counter
 *  
 * @returns json_encode $response
 * ***/
function responses ($res) {
    header('Content-type: application/json');
    $response = [
        "Type" => "Response",
        "Message" => $res,
        "sessionId" => $_SESSION["sessionId"],
        "serviceCode" => $_SESSION["serviceCode"],
        "operator" => $_SESSION["operator"],
        "counter" => $_SESSION["counter"],
        "last" => $_SESSION["last"],
        "time" => "about ".(time() - $_SESSION["timer"] ) ."sec used!",
    ];
    if(gettype($res) == "string"){
        if(trim($res) == "Payment made successfully! THANK YOU FOR USING CITSA-USSD!!."){
            session_destroy();
        }
    }

   echo json_encode($response);
}


/***
 * FUNCTION TO IMPLEMENT  ON REPLYS
 * 
 * @params $array789
 * @params $text
 * 
 * @returns void
 * 
 * **/
function doOnReturn ($array789,$text,$phoneNumber){
    $counter = $_SESSION["counter"] + 1;
    $_SESSION["counter"] = $counter;
    responses($array789[$counter][$text]);
    $_SESSION["counter"] = 0;
    saveUssdTransactionDetials ($phoneNumber);
    session_destroy();
}

function saveUssdTransactionDetials ($userPhoneNumber) {

    saveActivity (["phonenumber"=>$userPhoneNumber,"options_selected"=>json_encode($_SESSION["last"])]);
    saveTrasactionHistory (["phonenumber"=>$userPhoneNumber,"Operator"=>$_SESSION["operator"],
    "service"=>$_SESSION["serviceCode"],"type"=>"dues","amount"=>isset($_SESSION["amount"]) ? $_SESSION["amount"] : 0 ]);
    
}


/***
 * THIS FUNCTION  GETS USERS DETAILS
 * 
 * @params $text
 * 
 * @returns []
 * 
 * **/
function getDetails ($text) {
    $details  = explode("*",$text);
    $_SESSION["serviceCode"] = $details[1];
    $operators = operators();
    $_SESSION["operator"] = $operators[$details[2]];

    return [];
}

if(isset($_SESSION["sessionId"]) && isset($_SESSION["counter"])){

    
    try{

        if(time() - $_SESSION["timer"] > 100){
            responses ("Session Time out!");
            session_destroy();
        }else{
            if($userPhoneNumber != ""){ // CHECK THAT PHONE NUMBER IS NOT EMPTY!

                $array789 = $_SESSION["array789"];
                $arrayAmount789 = $_SESSION["arrayAmount789"];

                if($processType == "init" && strlen($text) == 13 ){  // CHECK THAT ITS THE INITIAL PROCESS AND STRING IS CORRECT
                    $counter = $_SESSION["counter"] + 1;
                    $_SESSION["counter"] = $counter;
                    getDetails ($text);
                    responses($array789[$counter]);
                }else{
                    if($text != "" && $_SESSION["counter"] < 7 && $text != "0" ){

                        if($_SESSION["counter"] == 2 ){ // CHECK THAT USER SELECT  AN AMOUNT TO PAY
                            $_SESSION["amount"] = $arrayAmount789[$text];
                        }

                        $counter = $_SESSION["counter"] + 1; // INCREASE COUNTER BY 1 
                        $_SESSION["counter"] = $counter; // SET COUNTER BACK INTO SESSION 

                        

                        $vc = !isset($array789[$counter][$text][1]) == "Undefined" ? "" : gettype($array789[$counter][$text][1]);

                        if(  $vc == "array" ){ // check that the reponse is not an array!
                            $arrayCoppied = $_SESSION["last"];
                            responses($array789[$counter][$text][$arrayCoppied[count($arrayCoppied)-1]]);
                        }
                        else{
                            if(strlen($text) == 4){
                                responses($array789[$counter][4]);
                            }else{
                                responses($array789[$counter][$text]);
                            }
                        }

                        $last_option = $_SESSION["last"];
                        array_push($last_option,$text);
                        $_SESSION["last"] = $last_option ;

                    }else if($text != "" &&  $text == "0"){
                        if($_SESSION["counter"] == 3  ){ // CHECK THAT USER SELECT  AN AMOUNT TO PAY
                            $_SESSION["amount"] = 0;
                    }
                        doOnReturn($array789,$text,$userPhoneNumber);
                    }else{
                        doOnReturn($array789,$text,$userPhoneNumber);
                    }
                }
                // throw new Exception("Oops something happend, Try again! ");
            }else{
                responses(["phone"=>"is required"],"No session initialized");
            }
         }

    }catch(Exception $e){
        echo $e->getMessage();
    }

}else{
    echo json_encode([$_SESSION["sessionId"] => $_SESSION["counter"]]);
}


