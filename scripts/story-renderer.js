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
	
	/**
	Functions
	**/

	function renderStories() {
		$('#story-list').sortable({
			stop: function(event, ui) { arrangeStories(); }
		});
	}
	
	function arrangeStories() {
		var itms = $('.story-listed');

		$.each(itms, function(i, p){
			$(p).attr('id', i);
		});
	}
	
});