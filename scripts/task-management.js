/**

Author: Rickard Lund
Created: 2011-03-29
Purpose: Handle Javascripts for task-entities.
Comment:
	Saves/reloads data and transforms visual elements of task-entities
	Currently a "placeholder" to show off expected "style" of code,
	and or functionality
	
Uses:
	jQuery Javascript Library - /jquery/jquery.js
	jQuery User Interface Library - /jquery/jquery-ui.js

**/

$(document).ready(function(){
	
	//On-click-events
	
	$('#element').click(function() { loadTasks(); } );
	$('#save_element').click(function() { saveTasks(); } );
	$('#remove_element').click(function() { removeTask(); } );
	
	// Functions
	
	function loadTasks() {
		
	}
	
	function saveTask() {
		
	}
	
	function removeTask() {
		
	}
});