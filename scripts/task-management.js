/**

Author: Rickard Lund
Created: 2011-03-29
Purpose: Handle Javascripts for task-entities.
Comment:
	Sends requests to manipulate data of task-entities.
	Currently a "placeholder" to show off expected "style" of code,
	and or functionality
	
Uses:
	jQuery Javascript Library - /jquery/jquery.js
	jQuery User Interface Library - /jquery/jquery-ui.js

**/

$(document).ready(function(){
	
	/**
	Event-handling
	**/
	
	$('#element').click(function() { loadTasks(); } );
	$('#save_element').click(function() { saveTasks(); } );
	$('#remove_element').click(function() { removeTask(); } );
	
	/**
	Functions
	**/

	function loadTasks() {
		
	}
	
	function saveTask() {
		
	}
	
	function removeTask() {
		
	}
});