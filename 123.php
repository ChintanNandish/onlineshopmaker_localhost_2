<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$str = file_get_contents('user_folders/nandish_admin/product_data.json');
$json = json_decode($str, TRUE);
$shopname = array_keys($json)[0];
$product = $json[$shopname];
$count = 0;
$keys = array_keys($product[array_keys($product)[0]]);
foreach($keys as $k){
	$sheet->setCellValue(chr(ord('A')+$count).'1', $keys[$count]);     //setting column name here
	$count++;
}
$count=0;
$number = 2;
foreach($product as $p){
	foreach($p as $values){
		if($values != ''){
			$sheet->setCellValue(chr(ord('A')+$count).$number, $values); //setting values of the products
		}
		else{
			$sheet->setCellValue(chr(ord('A')+$count).$number, 'N.A');
		}
		$count++;
	}
	$count = 0;
	$number++;
}


$writer = new Xlsx($spreadsheet);
$writer->save('user_folders/nandish_admin/'.$shopname.'_product_list.xlsx');


?>
