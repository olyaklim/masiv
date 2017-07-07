<!DOCTYPE HTML>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Bootstrap -->
	<link href="stylesheet/bootstrap.min.css" rel="stylesheet">
	<link href="stylesheet/my.css" rel="stylesheet">
</head>

<html>
<body>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-7">
				<div class="converter-wrap">

					<h1>Изучение массивов</h1>					

					<h2>Пошук повторяющиїхся слів в масиві довжини n і виведення кількість їх повторень на екран</h2>
					<form id="form" method="post" class="form-inline">

						<div class="form-group">
							<label class="control-label" for="count_array">Длинна массива:</label>
							<input id="count_array" class="form-control" type="number" name="count_array" required  placeholder="Длинна"  value="5" min="1" max="100" step="1">
						</div>

						<!-- <div class="form-group">

							<label class="control-label" for="name_val">Валюта:</label>
							<select id="name_val" class="form-control" required size = "1" name = "name_val">
								<option disabled>Валюта</option>
								<option selected value = "USD">USD</option>
								<option value = "EUR">EUR</option>
								<option value = "RUR">RUR</option>
							</select>
						</div>	 -->					

						<button type="submit" value="send" class="btn btn-success">Рассчитать</button>
						<br><br>

						<!-- <div class="form-group course-group">			 
							<label class="control-label" for="course-curr">Курс:</label>
							<input id="course-curr" class="form-control" type="number" name="val_ua" disabled required placeholder="Курс">
						</div> -->

					</form>
					
					<div id="result3"></div>
					<br>
					<br>
					<div id="result"></div>
					<br>
					<div id="result2"></div>
					<br>

				</div>
			</div>
		</div>
	</div>

	<script>
		$('#course-curr').val('<?php echo $course_curr; ?>');

		$(function() {
			$('#name_val').on('change', function() {
				var name_val = $('#name_val').val();


				$('#result').html(''); 
				$('#result2').html(''); 
				$('#result3').html(''); 

			})
		});

		$("#form").submit(function(e) {
			// var name_val = $("#name_val").val();
			// var course_curr = $("#course-curr").val();
			var count_array = $("#count_array").val();
			// console.log(count_array);

			// $('.course-group').css('display','block');

			$.ajax({
				type: "POST",
				url: "return_array.php",
				data:{count_array: count_array},
				dataType: 'json',
					error: function(data) {
						$('#result').html('<p class="text-error" style="color:#f5345f">Ошибка чтения!</p>'); 
					},
					success: function(data) {
						// $('#course-curr').val(data.kurs);
 
						$('#result2').html('<b>Многомерный массив с количеством: </b> <pre>' + data.print_array + '</pre>');
						$('#result3').html('<b>Массив: </b> <pre>' + data.array_s + '</pre>');
					}
				});

			e.preventDefault();
		});

	</script>

	<script src="js/bootstrap.min.js"></script>

</body>
</html>


