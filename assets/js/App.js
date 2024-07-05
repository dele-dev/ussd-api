class App{

currentValue = "45";
previousText = "";
publicStatus = {
	initiate : "",
	valuesNext : []
}

  constructor (){

  }
	
listenMiuseEvent(){

	document.getElementById("form_pay").addEventListener("mouseover", eve=>{
		if(this.getScreenText().trim() == "THANK YOU FOR USING CITSA-USSD!!." || this.getScreenText().trim() == "PASSWORD NOT MATCH! eXIT MADE."){
			this.resetToDefault();
		}
	});
}

resetToDefault (){
	this.publicStatus.initiate = "";
	this.publicStatus.valuesNext=[];
}


ussdResponses (object){

	console.log(object);

	if(object.Type == "Response"){

		this.displayScreen(object.Message) ;
		console.log(object);
	}
}

displayScreen(text){
	document.getElementById("displayText").innerHTML = text;
}
// displayScreen(text){
// 	document.getElementById("displayText").innerHTML = text;
// }
getScreenText(){
	return document.getElementById("displayText").textContent;
	// return 78;
}
getInputText(){
	return document.getElementById("displayValue").value;
	// return 78;
}

displayText (text) {
	this.currentValue = this.getInputText();
	this.setTextToInput (`${this.currentValue}${text}`) ;
}

setTextToInput (text) {
	document.getElementById("displayValue").value = text;
}

clearText (){
	document.getElementById("clearText").addEventListener("click", eve=>{
		eve.preventDefault();
		this.clearTextField();
	});
}

clearTextField (){
	this.setTextToInput("");
}


cancelText (){
	document.getElementById("cancelText").addEventListener("click", eve=>{
		eve.preventDefault();
		var tempHold = this.getInputText() ; 
		this.setTextToInput(`${tempHold.slice(0,tempHold.length-1 )}`)
	});
}

sendButton (){

	document.getElementById("processussd").addEventListener("click", eve=>{
		eve.preventDefault();

		console.log(this.publicStatus);

		var valueField = this.getInputText() ; 

		if(valueField == ""){ // check that field is not empty!

			this.displayScreen("Field can't be empty!") ; // this play error message is field is empty!

		}else{

			if(this.publicStatus.initiate == "*789*123*000#" &&  valueField.trim() == "*789*123*000#" ){

				this.displayScreen("<b> Transaction already initiated, <br> kindly select given option to continue!</b>") ;

			}else if(this.publicStatus.initiate == "" &&  valueField.trim() == "*789*123*000#" ) {

				if(valueField.trim() == "*789*123*000#"){

					this.ajaxRequest ("ussd.php",valueField,"init") ;

				}else{

					this.displayScreen("<b>Invalid code!</b>") ;
				}

			}else if(this.publicStatus.initiate == "*789*123*000#" &&  valueField.trim() != "*789*123*000#" && this.publicStatus.valuesNext.length == 0 ) {

				if(valueField.trim() != ""){
					this.ajaxRequest ("ussd.php",valueField,"reply") ;
					this.publicStatus.valuesNext.push(1);
				}else{
					this.displayScreen("<b>Select a valid code!</b>") ;
				}
			}
			else if(this.publicStatus.initiate == "*789*123*000#" &&  valueField.trim() != "*789*123*000#" && this.publicStatus.valuesNext.length == 1 ) {

				if(valueField.trim() != ""){
					this.ajaxRequest ("ussd.php",valueField,"reply_next") ;
					this.publicStatus.valuesNext.push(2);
				}else{
					this.displayScreen("<b>Select a valid code!</b>") ;
				}
			}
			else if(this.publicStatus.initiate == "*789*123*000#" &&  valueField.trim() != "*789*123*000#" && this.publicStatus.valuesNext.length == 2 ) {

				if(valueField.trim() != ""){

					this.ajaxRequest ("ussd.php",valueField,"reply_next_response") ;
					this.publicStatus.valuesNext.push(3);
				}
				else{
					this.displayScreen("<b>Select a valid code!</b>") ;
				}
			}
			else if(this.publicStatus.initiate == "*789*123*000#" &&  valueField.trim() != "*789*123*000#" && this.publicStatus.valuesNext.length == 3 ) {
			
				if(valueField.trim() != ""){
			 		if (this.getScreenText().trim() == "WELCOME TO CITSA. Input password to make Payment for dues"){
					 this.previousText = this.getInputText();
					 this.setTextToInput('');
					 this.displayScreen("<b>Confirm password to make Payment for dues</b>")
					//  this.setTextToInput('Confirm password to make Payment for dues');
					}
					else if (this.getScreenText().trim() == "Confirm password to make Payment for dues"){
						if(this.previousText != "" &&  this.previousText == this.getInputText()){
							this.displayScreen("<b>THANK YOU FOR USING CITSA-USSD!!.</b>");
							this.setTextToInput('');
						}else{
							this.displayScreen("<b>PASSWORD NOT MATCH! eXIT MADE.</b>");
							this.setTextToInput('');
						}
					}else{
						this.ajaxRequest ("ussd.php",valueField,"reply_next_response") ;
					}
				}
				else{
					this.displayScreen("<b>Select a valid code!</b>") ;
				}
			}

		}
	});
}

getBuuton(){
	
	var buttonList = document.querySelectorAll(".buttonToClick");
	
	buttonList.forEach( button => {
		button.addEventListener("click",e =>{
			e.preventDefault();
			var clickedText = button.textContent; 
			this.displayText(clickedText);
		});
});

}


async ajaxRequest (url,text,type) {

		const data  = {
				message : text,
				serviceCode : 789,
				operator:"mtn",
				type : type,
		};

		const endpoint = `${url}`;
		console.log(endpoint);
		try{
			console.log(JSON.stringify(data));
		  const response = await fetch(endpoint, {
			method: "POST",
			cache: 'no-cache',
			headers: {
				'Accept': 'application/json',
				"Content-Type": "application/json",
				// 'Content-Type': 'application/x-www-form-urlencoded',
			  },
			  body: JSON.stringify(data), // body data type must match "Content-Type" header
		});

		  if(response.ok){
			const jsonResponse = await response.json();
			this.ussdResponses(jsonResponse);
			this.publicStatus.initiate = "*789*123*000#";
			this.clearTextField ();
		  }else{
			this.ussdResponses({
				'Type':"Response",
				'Message':'<b>Network issues try again!</b>'});
				this.clearTextField ();
				this.resetToDefault();
				console.log(4554545);
		  }
		}
		catch(error){
		  this.ussdResponses({
			'Type':"Response",
			'Message':'<b>Network issues try again!</b>'});
			 this.clearTextField ();
			 this.resetToDefault();
		  console.log(error);
		}

}




init(){
	console.log(675656566);
	this.getBuuton 	();
	this.clearText 	();
	this.cancelText ();
	this.sendButton ();
	this.listenMiuseEvent ();
}


}

var pay = new App();
pay.init();



/***function getUserData(form,error_message){
	
	var formDocument = document.getElementById(form);
	console.log(formDocument.children);

	// form validation 
	// check that fields are not empty!
	
	var validateEmpty = isEmpty (formDocument);
	if(validateEmpty[0] == true){
		console.log(validateEmpty[1]);
		document.getElementById(error_message).innerHTML = validateEmpty[1];
	}
}

function isEmpty (formDocument) {
	
	for(var i= 0 ; i < formDocument.length; i++ ){ // loop through all elements of form

		console.log(formDocument[i]);

		// check that form child is not button 
		if(formDocument[i].localName !== "button"){

			console.log(formDocument[i].localName);
			
			// check if input is not empty
			if(formDocument[i].value.trim() == ""){
				var isEm = `${formDocument[i].name} Field can't be empty!`; 
				return [true,isEm] ;
			}
		}
	}

	return [false];
	
}

function runIT (){
	
	document.getElementById("paymentbutton").addEventListener("click",e =>{
		e.preventDefault();
		getUserData("form_pay","error_span");
	});
}


runIT ();**/