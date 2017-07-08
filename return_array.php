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

 function task1($array, $my_array)
 {
 	$comment = "";
 // 	// Заполним доп массив
	// foreach($array as $val) {
	// 	$my_array[$val] = 0;
	// }

 	//Считаем слова
	foreach($array as $val) {
		$my_array[$val] = $my_array[$val] + 1;
	}


	$print_result 	= print_r($my_array, true);
	$array_print 	= print_r($array, true);

	return array(
		'print_result' => $print_result,
		'array_print' => $array_print,
		'comment' => $comment
	);
 }

 function task2($array, $my_array)
 {
 	$comment = "Удален 2-й элемент массива. Массив ";

 	// Заполним доп массив
	foreach($array as $val) {
		$my_array[] = $val;
		
	}

	unset($my_array[1]);

	// Переиндексация:
	 $my_array = array_values($my_array);


	// Заполним sort массив
	foreach($my_array as $val) {
		$my_array_sort[] = $val;
		
	}

	 sort($my_array_sort, SORT_STRING);

	 $is_sort = true;
	 for($i=0; $i < count($my_array); $i++) {

	 	if ($my_array[$i] !== $my_array_sort[$i]) {
	 		$is_sort = false;
	 		break;
	 	}
	 }

	
	$comment_sort = $is_sort ? "отсортирован по возрастанию!" : " не отсортирован!";

	$comment = $comment . $comment_sort;

	$print_result = print_r($my_array, true);
	$array_print  = print_r($array, true);

	return array(
		'print_result' => $print_result,
		'array_print' => $array_print,
		'comment' => $comment
	);
 }

// if ($task == 1) { 
// 	require_once 'task1.php';
// }

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







switch ($task) {
    case 1:
        $result = task1($array, $my_array);
        break;
    case 2:
         $result = task2($array, $my_array);
        break;
    case 3:
        echo "i равно 2";
        break;
}






// if ($task == 2) {
// 	$comment = "Массив отсортирован по возрастанию!";
// }

// $result = array(
// 	'print_result' => $print_result,
// 	'array_print' => $array_print,
// 	'comment' => $comment
// );



echo json_encode($result);



