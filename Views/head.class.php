<?php

/**
	Authour: Rickard Lund
	Created: 2011-05-22
	Purpose: To print head-tag for HTML-views
	Comment: Uses functions to make individual parts of the head first,
			 then concatenates it all together and echoes it.
	
	@package Entities
	uses:
		n/a - n/a
		  
**/
class Head
{
	static public $open_head = '<head>';
	static public $close_head = '</head>';
	
	private $doctype = '';
	private $meta = '';
	private $title = '';

	private $jquery = '';
	private $javascript = '';
	private $css = '';

	private $jquery_paths = array('jquery.js', 'jquery-ui.js');
	private $javascript_paths = array('user.js');
	private $css_paths = array('head.css', 'content.css', 'footer.css');

	public function __construct($page)
	{
		$this->setDoctype();
		$this->setMeta();
		$this->setTitle();
		$this->outputHead();
	}

	private function outputHead() {
		echo $this->doctype
			. self::$open_head
			. $this->meta
			. $this->title
			. $this->jquery
			. $this->javascript
			. $this->css
			. self::$close_head;
	}

	private function setDoctype() {
		$this->doctype = '<!DOCTYPE html>';
	}

	private function setMeta() {
		$this->meta = '<meta></meta>';
	}

	private function setTitle() {
		$title = str_replace('.php', '', str_replace('/', ' | ', $_SERVER['PHP_SELF']));
		$this->title = '<title>' . $title . '</title>';
	}

	private function setJquery() {
		foreach ($this->jquery_paths as $path) {
			$this->jquery .= '<script src="/'. $path .'" type="text/javascript" charset="utf-8"></script>';
		}
	}

	private function setJavascript() {
		foreach ($this->javascript_paths as $path) {
			$this->javascript = '<script src="/'. $path .'" type="text/javascript" charset="utf-8"></script>';
		}
	}

	private function setCss() {
		
	}
}


?>