<?php
// PDO connect *********
function connect() {
	$dsn = getenv('MYSQL_DSN');
    $user = getenv('MYSQL_USER');
    $password = getenv('MYSQL_PASSWORD');
    //return new PDO('mysql:host=golden-era-150418:us-central1:demo-db;dbname=autocomplete', 'root', 'HFSKSKE&&^%21322fdhshe', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    return new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
//$sql = "SELECT * FROM country WHERE country_name LIKE (:keyword) ORDER BY country_id ASC LIMIT 0, 10";
$sql = "SELECT * FROM demo WHERE product LIKE (:keyword) ORDER BY sku ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	// $country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['country_name']);
	$product = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['product']);
	// add new option
    // echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['country_name']).'\')">'.$country_name.'</li>';
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['product']).'\')">'.$product.'</li>';
}
?>
