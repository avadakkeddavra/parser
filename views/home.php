<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<style>
		header{
			padding:30px 0px;
			color: #fff;
			background-color: #000;
			line-height: 54px;
		}
		header h1{
			display: inline-block;
			margin-bottom: 0px;
		}
		#parse{
			background-color: transparent;
			border:2px solid #fff;
			padding: 7px 25px;
			line-height: normal;
			position: relative;
			top:-5px;
			display: inline-block;
			margin: 0;
			margin-left: 15px;
			font-size: 18px;
			font-weight: bold;
			color: #fff;
			transition: 0.3s;
		}
		#parse:hover{
			border-color: #dc6b6b;
			color: #dc6b6b;
		}
		@keyframes rotate{
			0%{
				transform: rotate(0deg)
			}
			100%{
				transform: rotate(360deg);
			}
		}
		.preloader{
			display: block;
			text-align: center;
			padding: 50px 0px;
			display: none;
		}
		.preloader .spin{
			display: inline-block;
			width: 80px;
			height: 80px;
			border: 2px solid transparent;
			border-top:2px solid #000 !important;
			border-radius: 50%;
			position: relative;
			transition: 0.3s;
			animation: rotate 2s infinite;
		}
		.preloader .spin:after{
			content: '';
			position: absolute;
			left: 50%;
			border:2px solid transparent;
			border-top:2px solid #000 !important;
			width: 60px;
			height: 60px;
			margin: 0 -30px;
			top: 8px;
			border-radius: 50%;
			transition: 0.3s;
			animation: rotate 1s infinite;
		}
		.preloader .spin:before{
			content: '';
			position: absolute;
			left: 50%;
			border:2px solid transparent;
			border-top:2px solid #000 !important;
			width: 40px;
			height: 40px;
			margin: 0 -20px;
			top: 18px;
			border-radius: 50%;
			transition: 0.3s;
			animation: rotate 0.7s infinite;
		}
	</style>
</head>
<body>
	<header>
	<div class="container">
			<h1>Parser</h1>
			<button id="parse">Reload</button>
	</div>
	</header>
	<section class="container">
	
	<div class="preloader">
		<span class="spin"></span>
	</div>
		<table id="product_table" class="table table-striped" width="90%">
			<thead>
				<tr>
					<td>Название</td>
					<td>Цена</td>
					<td>Дата</td>
				</tr>
			</thead>

			<?php 
		
				foreach($data as $item) :
				?>
				<tr>
						<td><?php echo  $item['title'] ?></td>
						<td><?php echo  $item['price'].'$'; ?>
							<?php echo '<br>'.$item['quantity'].' шт';?>
						</td>
						<td><?php echo date('h:i:s'); ?></td>
						
				</tr>

			<?php 
				endforeach;
			 ?>
		</table>
	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	$(document).ready(function(){

		$("#parse").click(function(){
			$('.preloader').show();
			$('#product_table').children('tbody').children('tr').remove();

			$.ajax({
				url:'/Main/parse',
				type:'POST',
				data: '',
				cache: false,
				dataType:'json',
				success: function(response){
					console.log(response);
					var data = response;
					var date = new Date();
					for(var count in data)
					{
						(function(){
							var options = count;
							$('#product_table').children('thead').append('<tr><td>'+data[options]['title']+'</td><td>'+data[options]['price']+'$<br>'+data[options]['quantity']+' шт</td><td>'+data[options]['time']+'</td></tr>');
						})();
					}
					$('.preloader').hide();
				}
			})
		})
	})

	</script>
</body>
</html>