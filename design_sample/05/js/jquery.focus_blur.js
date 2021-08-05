/*--------------------------------------------------------------------------------------------
*
*	Focus / Blur
*
*	@author : Elliot Condon - Carter Digital 2011
*	@usage :
	<form id="search">
		<label for="s" style="display: block;">Search</label>
		<input type="text" id="s">
		<input type="submit">
	</form>
	<script type="text/javascript">
		$('#serach').focus_blur();
	</script>
*
*--------------------------------------------------------------------------------------------*/

$.fn.focus_blur = function()
{
	var form = $(this);
	
	// label focus / blur
	form.find('input[type="text"], input[type="password"], textarea').focus(function(){
	
		var name = $(this).attr('id');
		form.find('label[for="' + name + '"]').hide();
		
	});
	
	form.find('input[type="text"], input[type="password"], textarea').blur(function(){
	
		var name = $(this).attr('id');
		if($(this).val() == "")
		{
			form.find('label[for="' + name + '"]').show();
		}
		
	});
	
	// timout fixes chrome remember password issue
	setTimeout(function(){
		form.find('input[type="text"], input[type="password"], textarea').each(function(){
			
			if($(this).val() != "")
			{
				var name = $(this).attr('id');
				form.find('label[for="' + name + '"]').hide();
			}
			
		});
	}, 100);
};


$(document).ready(function()
{
	$('form.focus-blur').each(function(){
		$(this).focus_blur();
	});
});