<?php
if(!(isset($_GET["Token"])) || !(isset($_GET["axeon"])) || !(isset($_GET["object"]))){
	header("Location: ./");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<title>AXEON MERCADO PUBLICO</title>
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
		<!-- Just for debugging purposes. Don't actually copy this line! -->
		<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url('images/embedi.png') 50% 50% no-repeat rgb(249,249,249);
			}
			.table > thead > tr > th,
			.table > tbody > tr > th,
			.table > tfoot > tr > th,
			.table > thead > tr > td,
			.table > tbody > tr > td,
			.table > tfoot > tr > td {
			  padding: 8px;
			  line-height: 1.42857143;
			  vertical-align: top;
			  border-top: 0px solid #ddd;
			}
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(window).load(function() {
			  $(".loader").fadeOut("slow");
			})
		</script>
	</head>
	<body data-spy="scroll" data-offset="0" data-target="#theMenu">
		<section id="home" name="home"></section>
		<div style="padding-top: 25px; height:100vh;" id="headerwrap">
			<div class="container">
				<div class="row">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<h1>AXEON</h1>
							<h2 class="sub">Mercado Público</h2>
						</div>
					</div>
					<div class="table-responsive">
					  <table class="table" id="headerwrapa" style="font-family: 'Righteous', cursive; font-size:1.5em;margin-left:25%; width:50%;">
							<thead style="background: rgba(26, 122, 138, 1); color:white;">
								<tr>
									<th colspan="2">
										<input type="hidden" id="hashiko" value="">
										<center>Detalle de Cobro</center>
									</th>
								</tr>
							</thead>
							<tbody style="background: rgba(26, 122, 138, 0.65); color:white;">
								<tr>
									<td>Nombre:</td>
									<td id="nomDetail"></td>
								</tr>
								<tr>
									<td>Empresa:</td>
									<td id="empDetail"></td>
								</tr>
								<tr>
									<td>Rut:</td>
									<td id="rutDetail"></td>
								</tr>
								<tr>
									<td>Email:</td>
									<td id="emaDetail"></td>
								</tr>
								<tr>
									<td>Plan:</td>
									<td id="plaDetail"></td>
								</tr>
								<tr>
									<td>Total a Pagar:</td>
									<td id="pagDetail"></td>
								</tr>
								<tr>
									<td colspan="2">
										<form action="https://khipu.com/api/1.1/createPaymentPage" method="POST">
											<input type="hidden" name="receiver_id" id="receiver_id" value="">
											<input type="hidden" name="subject" id="subject" value=""/>
											<input type="hidden" name="body" id="body" value="">
											<input type="hidden" name="amount" id="amount" value="">
											<input type="hidden" name="notify_url" id="notify_url" value=""/>
											<input type="hidden" name="return_url" id="return_url" value=""/>
											<input type="hidden" name="cancel_url" id="cancel_url" value=""/>
											<input type="hidden" name="custom" id="custom" value="">
											<input type="hidden" name="transaction_id" id="transaction_id" value="">
											<input type="hidden" name="payer_email" id="payer_email" value="">
											<input type="hidden" name="picture_url" id="picture_url" value="">
											<input type="hidden" name="hash" id="hashi" value="">
											<input type="image" src="https://s3.amazonaws.com/static.khipu.com/buttons/100x50.png">
										</form>
									</td>
								</tr>
							</tbody>
					  </table>

					</div>
				</div>
			</div>
		</div>
			<!-- /container -->
		<!-- Bootstrap core JavaScript
			================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="assets/js/classie.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/smoothscroll.js"></script>
		<script src="assets/js/jquery.stellar.min.js"></script>
		<script src="assets/js/fancybox/jquery.fancybox.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="js/jerso.js"></script>
	</body>
</html>
