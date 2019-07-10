<?php
//namespaces
namespace BenjaminDeumier\BlogP4\Model;

//fonctions
class Manager
{
	protected function dbConnect()
	{
    	$db = new \PDO('mysql:host=localhost;dbname=blogp4;charset=utf8', 'root', '');
    	return $db;
	}
}