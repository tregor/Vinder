<?php
ini_set("display_errors", TRUE);
error_reporting(E_ALL);
include "lib/Vinder.php";

$data = [
	"testString" => "test by tregor!",
	"testArray"  => [
		"data"  => "testArray data",
		"test"  => [
			"data" => "testArray['test'] data",
		],
		[
			"data" => "testArray[0] data",
			"testArray[0][0] data",
			[
				"data" => "testArray[0][0] data",
			],
		],
		"class" => new TestClass(),
	],
	"i"          => 0,
	"hi_world"   => "Hello, World from data!",
	"class"      => new TestClass(),
];

class TestClass
{
	public $item;

	public function __construct($item = "class item") { $this->item = $item; }

	public function method($item = 1997) { return "class method, item = {$item}"; }

	public function methodReturningClass() { return new TestClass("class " . rand(1, 100) . " item"); }
}

$page = new Vinder("main", $data, TRUE);
$page->render();