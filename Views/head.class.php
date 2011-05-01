<?php

/**
* 
*/
class Head
{
	public $head;
	
	private $page = '';
	private $doctype = '';
	private $meta = '';
	private $title = '';
	private $javascript_paths = array();
	private $css_paths = array();

	static private $jquery_paths = array('jquery.js', 'jquery-ui.js');

	function __construct($page)
	{
		$this->setDoctype();
		$this->setMeta($this->meta);
		$this->setTitle($this->title);
	}
}


?>