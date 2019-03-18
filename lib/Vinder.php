<?php
session_start();

/**
 * Copyright (c)
 * by tregor 18.3.2019.
 */
class Vinder
{
	private $template;
	private $HTML;
	private $data;
	private $vinderData;

	public function __construct($template, $data, $evalPHP = FALSE)
	{
		$this->vinderData = [
			"template" => $template,
			"version"  => "1.0",
			"config"   => [
				"evalPHP" => $evalPHP,
			],
			"request"  => [
				"get"     => $_GET,
				"post"    => $_POST,
				"cookie"  => $_COOKIE,
				"server"  => $_SERVER,
				"session" => $_SESSION,
			],
		];
		$this->data = $data;
		$this->template = $template;
		$this->HTML = file_get_contents("template/{$template}.vinder");
		$this->parseInclude();
		$this->parseVariables();
		$this->parseComments();
	}

	public function render()
	{

		if ($this->vinderData['config']['evalPHP']) {
			$this->getContentWithPHP();
		} else {
			echo $this->getContent();
		}
	}

	public function getContentWithPHP()
	{
		eval("?>" . $this->getContent() . "<?");
	}

	public function getContent()
	{
		return $this->HTML;
	}

	private function parseInclude()
	{
		$this->HTML = preg_replace_callback('/<!inc@(.*)!>/isU', function ($matches) {
			$includeFilename = str_replace(".", "/", $matches[1]);
			return (new Vinder($includeFilename, $this->data))->getContent();
		}, $this->HTML);
	}

	private function parseVariables()
	{
		$this->HTML = preg_replace_callback('/<!\$(.*)!>/iU', function ($matches) {
			if (stripos("$matches[0]", ".$", 1)) {
				$variable = preg_replace_callback('/\$([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)/i', function ($submatches) { return eval('return $this->data[\'' . $submatches[1] . '\'];'); }, $matches[1]);
				$variable = preg_filter('/\.([0-9]*)/i', "[$1]", $variable);
				return eval("return " . preg_filter('/([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)\[/i', '$this->data[\'$1\'][', $variable) . ";");
			}
			if (stripos("$matches[0]", "->", 1)) {
				$variable = preg_replace('/([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)\./i', '$this->data[\'$1\'].', $matches[1], 1);
				if (stripos($variable, "($", 1)) {
					$variable = preg_replace_callback('/\(\$([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)/i', function ($submatches) { return "(" . eval('return $this->data[\'' . $submatches[1] . '\'];'); }, $variable);
				}
				return eval("return " . preg_filter('/\.([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)->([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)/i', "['$1']->$2", $variable) . ";");
			}
			if (stripos("$matches[0]", ".", 1)) {
				$variable = preg_replace('/([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)\./i', '$this->data[\'$1\'].', $matches[1], 1);
				return eval("return " . preg_filter('/\.([a-zA-Z_\x7f-\xff]+[a-zA-Z0-9_\x7f-\xff]*)/i', "['$1']", $variable) . ";");
			}

			//TODO: Предустановленные переменные. $vinder.template
			//TODO: Сделать эксепшн если не существует данных
			return $this->data[$matches[1]];
		}, $this->HTML);
	}

	private function parseComments()
	{
		$this->HTML = preg_replace('/<!\*\*(.*)\*\*!>/isU', "", $this->HTML);
		$this->HTML = preg_replace_callback('/<!\*(.*)\*!>/isU', function ($matches) {
			return "<!-- " . $matches[1] . " -->";
		}, $this->HTML);
	}
}