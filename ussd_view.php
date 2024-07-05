<!Doctype HTML>
<html>
	<head>
		<title>USSD PAY - CITSA</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="./assets/css/bootstrap.css" rel="stylesheet"/>
        <link href="./assets/css/style.css" rel="stylesheet"/>
	</head>
	<body>
		<div class="container">
			<div class="row image-cover">
				<img src="./assets/img/1.jpg" alt="Banner"/>
			</div>
			<div class="row">
				<h1>CITSA DUES PAYMENT</h1>
                <a href="index.html">Switch to PAYMENT</a>
				<span id="error_span"></span>
				<form action="" method="post" id="form_pay" >
					<div class="form-group phonecase  row" id="screentype">
						<lable for="fullname"> <p id="displayText">
                            <!-- <b>WELCOME TO CITSA <br> 1. Pay Due <br> 2.Check Last 2 transactions 
                        <br> 3. Exit</b> -->
                    </p></label>
						<input  class="form-control" type="text" id="displayValue" name="Message" placeholder="" required />
					</div>
                    <div class="row">
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >1</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >2</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >3</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >4</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >5</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >6</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >7</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >8</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >9</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >*</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >0</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn buttonToClick" type="" name="" >#</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn " id="clearText" type="" name="" >clear</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn " type="" id="processussd" name="" >SEND</button>
                        </div>
                        <div class="form-group phonecase  col-4">
                            <button class="btn btn " id="cancelText" type="" name="" >X</button>
                        </div>
                    </div>
				</form>
			</div>
			<div class="row footer-class">
				<h4>Designed by <span><a href="#">CITSA TEAM</a></span>, <br/> Powered by <span><a href="#">INTERPAY TEAM</a></span></h4>
			</div>
		</div>


	<!--- custome JS --->
	<script type="module" src="./assets/js/App.js"></script>
	</body>
</html>
