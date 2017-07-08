<?php 

// define("LINK", 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3');

// Ф-я красивого вывода массива
function print_arr($arr) 
{
	echo '<pre>' . print_r($arr, true) . '</pre>';
}

//Генерируем слово 
function get_word($count_letter = 4) 
{

	$array 		= range('a','c'); 
	$count_mas 	= count($array); 

	for($i=0; $i < $count_letter; $i++) {
		$word .= $array[rand(0, $count_mas -1)];
	} 
	return $word;
}

// Авто заполнение массива
function get_array(&$array, $count_array, $count_letter) 
{

	for($i=0; $i < $count_array; $i++) {
		$word = get_word($count_letter);
		$array[$i] = $word;
	}
}

//Получаем переменные
$array = [];
$my_array = [];

if (isset($_POST['task'])) {
	$task = (int) $_POST['task'];
}
else {
	exit("Выберите задание!"); 
}

if (isset($_POST['count_array'])) {
	$count_array = (int) $_POST['count_array'];
}
else {
	exit("Введите длинну массива!"); 
}



if (isset($_POST['autoword'])) {
	$autoword = (bool) $_POST['autoword'];
}
else {
	$autoword = false;
}


if (isset($_POST['mas'])) {
	$mas = (string) $_POST['mas'];

	if (!$autoword) {
		$array = explode(",", $mas);
	}

}


if (isset($_POST['count_letter'])) {
	$count_letter = (integer) $_POST['count_letter'];
}
else {
	$count_letter = 1; 
}

// Если массив пустой заполняем случайными словами
if (!count($array) || $auto_word) {
	$array = [];
	get_array($array, $count_array, $count_letter);
}

// Заполним доп массив
foreach($array as $val) {
	$my_array2[$val] = 0;
}

//Считаем слова
foreach($array as $val) {
	$my_array[$val] = $my_array[$val] + 1;
}


$print_result 	= print_r($my_array, true);
$array_print 	= print_r($array, true);

$result = array(
	'print_result' => $print_result,
	'array_print' => $array_print
);

echo json_encode($result);



