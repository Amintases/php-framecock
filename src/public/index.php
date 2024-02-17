<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';


function get_memory_limit()
{
	$memory_limit = ini_get('memory_limit');
	if (preg_match('/^(\d+)(.)$/', $memory_limit, $matches)) {
		if ($matches[2] == 'M') {
			$memory_limit = $matches[1] * 1024 * 1024; // nnnM -> nnn MB
		} else if ($matches[2] == 'K') {
			$memory_limit = $matches[1] * 1024; // nnnK -> nnn KB
		}
	}
	return $memory_limit * 0.2;
}


$connect = mysqli_connect('mysql', 'root', 'root', 'test');

$values = array();

$sqlText = "insert into colors(name, short_name, author) values ";

$memory_limit = get_memory_limit();


for($i=0; $i<=100000000; $i+=1){
	if($memory_limit < memory_get_usage()) break;
	$sqlText .= "('name','short_name','author'),";
//
}
$sqlText = substr($sqlText,0,-1);

$start = microtime( true );

$res = $connect->query($sqlText);
var_dump($res);
echo "<hr>";

$diff = sprintf( '%.6f sec.', microtime( true ) - $start );
var_dump($diff);
echo "<hr>";

$res = $connect->query('select count(*) from colors');
var_dump($res->fetch_assoc());
echo "<hr>";

$res = $connect->query('truncate colors');
var_dump($res);
echo "<hr>";




//use Framework\Http\Request;
//use Framework\Http\Kernel;
//
//$request = Request::createFromGlobals();
//
//$kernel = new Kernel();
//$response = $kernel->handle($request);
//$response->send();

