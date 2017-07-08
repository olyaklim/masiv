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

<?php /*

$my_array[] = 'ccc';
$my_array[] = 'aaa';
$my_array[] = 'bbb';

$my_array_sort[] = 'aaa';
$my_array_sort[] = 'bbb';
$my_array_sort[] = 'ccc';



 $is_sort = true;
	 for($i=0; $i < count($my_array); $i++) {

echo $my_array[$i];
echo "<br>";
echo $my_array_sort[$i];

	 	if ($my_array[$i] !== $my_array_sort[$i]) {
	 		$is_sort = false;
	 		break;
	 	}
	 }

	 echo "<hr>";
echo $is_sort;

echo '<pre>' . print_r($my_array, true) . '</pre>';
	

$comment = "ss";
$comment = ($is_sort) ? "отсортирован по возрастанию!" : " не отсортирован!";
	 echo $comment;
 die();
	*/ ?>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-10">
				<div class="converter-wrap">

					<h1>Изучение массивов</h1>					

					<form id="form" class="form-inline">

						<div class="form-group">

							<label class="control-label" for="task">Задание:</label>
							<select id="task" class="form-control" required size = "1" name = "task">
								<!--<option disabled>Валюта</option> -->
								<option selected value = "1">Пошук повторяющиїхся слів в масиві довжини n і виведення кількість їх повторень на екран</option>
								<option value = "2">Видалити з масиву довжини n одне значення і визначити чи буде він відсортованим по зрослтанням</option>
								<option value = "3">Видалити з масива слова які повторяютсья більше n раз</option>
								<option value = "4">Пошук макс і мін значення в мпасиві довжини n</option>
								<option value = "5">З двух масивів сформувати третій масив, який міститиме значення(ключі) які є в обох масивах</option>	
							</select>
						</div>	
						<br><br>
						<div class="form-group mas-group">
							<b>   Массив: </b><span id="mas">word1,word2,word3,word3,word1,word1</span>
							<a id="btn-mas" class="btn btn-primary">Перезаполнить массив</a>
						</div>

					
						<div class="option-group">
							<div class="checkbox">
								<label><input id="auto-word" type="checkbox"> Автозаполнение массива</label>
							</div>	

							<div class="letter-group">
								<div class="form-group">
									<label class="control-label" for="count_array">Длинна массива:</label>
									<input id="count_array" class="form-control" type="number" name="count_array" required  placeholder="Длинна"  value="6" min="3" max="100" step="1">	
							


								<label class="control-label" for="count-letter">Количество букв в слове:</label>
								<input id="count-letter" class="form-control" type="number" name="count-letter" required  placeholder="десятичных знаков" value="1" min="1" max="10" step="1">

									</div>	
								
							</div>			
						</div>	

						
						<br>
						

						<br>
						<button type="submit" value="send" class="btn btn-success">Выполнить</button>
						<br><br>

					</form>
					
					<div id="comment"></div>
					<br>
					<div id="result3"></div>
					<br>
				
					<div id="result"></div>
					
					<div id="result2"></div>
					<br>
					<div id="result4"></div>
					
				</div>
			</div>
		</div>
	</div>

	<script>

		var count_array = $("#count_array").val();

		$(function() {
			$('#btn-mas').on('click', function() {

				count_mas = prompt("Введите длинну массива");

				$('#count_array').val(count_mas);

				var arr = new Array();
				for (i = 0; i < count_mas; i++)
					arr[i] = prompt("Введите " + (i + 1) + "-ое слово");

				var mas ='';
				for (i = 0; i < arr.length; i++) {
					mas= mas + String(arr[i]);

					if(i < arr.length-1){
						mas = mas + '\,';
					}
				}

				$('#mas').html(mas);
				// console.log(mas);

			})
		})


		$(function() {
			$('#auto-word').on('change', function() {
				$('.letter-group').toggle();
				//$('#mas').html('');
				$('.mas-group').toggle();
			})
		});


		$(function() {
			$('#name_val').on('change', function() {
				var name_val = $('#name_val').val();

				$('#result').html(''); 
				$('#result2').html(''); 
				$('#result3').html(''); 
				$('#result4').html(''); 
			})
		});


		// $(function() {
		// 	autoword = 0;
		// 	$('#auto-word').on('change', function() {
		// 		autoword = !autoword;
		// 		console.log(autoword);
		// 	})
		// });

		$("#form").submit(function(e) {

			if ($("#auto-word").is(':checked')) {
				autoword = 1;
			}
			else {
				autoword = 0;
			}
			var task = $("#task").val();
			

			var mas = $("#mas").html();
			var count_letter = $("#count-letter").val();
			var count_array  = $("#count_array").val();
			console.log(autoword);
			

			$.ajax({
				type: "POST",
				url: "return_array.php",
				data:{count_array: count_array,
					task:task,
					mas:mas,
					count_letter:count_letter,
					autoword:autoword

				},
				dataType: 'json',
					error: function(data) {
						$('#result').html('<p class="text-error" style="color:#f5345f">Ошибка чтения!</p>'); 
					},
					success: function(data) {
						// $('#course-curr').val(data.kurs);
 
						$('#result2').html('<b>Дополнительный массив: </b> <pre>' + data.print_result + '</pre>');
						$('#comment').html(' ' + data.comment);
						$('#result3').html('<b>Массив: </b> <pre>' + data.array_print + '</pre>');
						
						if (data.print_result2)
						$('#result4').html('<b>Массив2: </b> <pre>' + data.print_result2 + '</pre>');
					
					}
				});

			e.preventDefault();
		});

	</script>

	<script src="js/bootstrap.min.js"></script>

</body>
</html>


