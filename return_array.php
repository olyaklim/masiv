<?php 

// define("LINK", 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3');

// Ф-я красивого вывода массива
function print_arr($arr) {
	echo '<pre>' . print_r($arr, true) . '</pre>';
}

			//Генерируем слово 
function get_word($count_letter = 4) {

	$array 		= range('a','c'); 
	$count_mas 	= count($array); 

	for($i=0; $i < $count_letter; $i++) {
		$word .= $array[rand(0, $count_mas -1)];
	} 
	return $word;
}


//Получаем переменные

if (isset($_POST['count_array'])) {
	$count_array = $_POST['count_array'];
}
else {
	exit("Введите длинну массива!"); 
}

$array_s = []; 
$my_array = []; 
//Считаем слова
for($i=0; $i < $count_array; $i++) {
	$word = get_word(1);
	$my_array[$i][0]['word'] = $word;
	$my_array[$i][1]['word_count'] = 1;

	$array_s[$i] = $word;
}


$string_result = "";
foreach ($my_array as $word_array => $val) {

	$word_count = 0;

	for($i=0; $i < $count_array; $i++) {

		if (($val[0]['word'] == $my_array[$i][0]['word']) && ($word_array !== $i) ) {
			$my_array[$i][1]['word_count'] = $my_array[$i][1]['word_count'] + 1;
			$word_count++;
		}						
	}	
}


$print_array 	= print_r($my_array, true);
$array_s 		= print_r($array_s, true);

$result = array(
	'print_array' => $print_array,
	'array_s' => $array_s
);

echo json_encode($result);



