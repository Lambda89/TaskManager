/**

Author: Rickard Lund
Created: 2011-03-29
Purpose: Handle dom-manipulation for story-entities.
Comment:
	Rendering and visual manipulation of story-entities.
	Currently a "placeholder" to show off expected "style" of code,
	and or functionality
	
Uses:
	jQuery Javascript Library - /jquery/jquery.js
	jQuery User Interface Library - /jquery/jquery-ui.js
**/

$(document).ready(function(){

	var prefix = "s";
	
	/**
	Functions
	**/
	
	/**
	setStoriesSortable();
	Set stories-list to be sortable by jQuery UI.
	Set stop-event to trigger story arrangment.
	**/

	function setStoriesSortable(prefix) {
		$('#story-list').sortable({
			stop: function(event, ui, prefix) { arrangeStories(prefix); }
		});
	}
	
	/**
	arrangeStories();
	Finds all stories in a specified list.
	Reorders their IDs based on position in DOM-tree
	**/
	
	function arrangeStories(prefix) {
		var items = $('.story-listed');

		$.each(items, function(i, item){
			$(item).attr('id', prefix+i);
		});
	}
	
});