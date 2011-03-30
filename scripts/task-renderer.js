/**

Author: Rickard Lund
Created: 2011-03-29
Purpose: Handle dom-manipulation for task-entities.
Comment:
	Rendering and visual manipulation of task-entities.
	Currently a "placeholder" to show off expected "style" of code,
	and or functionality
	
Uses:
	jQuery Javascript Library - /jquery/jquery.js
	jQuery User Interface Library - /jquery/jquery-ui.js
**/

$(document).ready(function(){
	
	var prefix = "t";
	
	/**
	Functions
	**/

	function setTasksSortable(prefix) {
		$('#tasks').sortable({
			stop: function(event, ui, prefix) { arrangeTasks(prefix); }
		});
	}
	
	function arrangeTasks(prefix) {
		var items = $('.task-listed');
		
		$.each(items, function(i, item){
			$(item).attr('id', prefix+i);
		})
	}
	
});