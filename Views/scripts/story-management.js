/**

Author: Rickard Lund
Created: 2011-03-29
Purpose: Handle Javascripts for story-entities.
Comment:
	Sends requests to manipulate data of story-entities.
	Currently a "placeholder" to show off expected "style" of code,
	and or functionality
	
Uses:
	jQuery Javascript Library - /jquery/jquery.js
**/

$(document).ready(function(){
	
	/**
	Event-handling
	**/
	
	$('#element').live('click', function() { loadStories(); } );
	$('#save_element').live('click', function() { saveStory(); } );
	$('#remove_element').live('click', function() { removeStory(); } );
	
	/**
	Functions
	**/

	function loadStories() {
		
	}
	
	function saveStory() {
		
	}
	
	function removeStory() {
		
	}
});