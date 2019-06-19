<?php
//namespaces
namespace BenjaminDeumier\BlogP4\Model;

//fonctions
class Manager
{
	protected function dbConnect()
	{
    	$db = new \PDO('mysql:host=db5000105345.hosting-data.io;dbname=dbs99828;charset=utf8', 'dbu134915', 'Cerbere---mainP4DB');
    	return $db;
	}
}