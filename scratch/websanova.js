(function($)
{ 
	$.w = {
		
		convert_to_code_sample: function()
		{
			$('.demo_area').find('.convert_to_code_sample').each(function()
			{
				var code_sample_content = 
				$('<div class="code_sample_content"></div>')
				.css({marginTop: 10, width: $(this).parent().width() - parseInt($(this).parent().css('paddingLeft').split('px')[0]) * 2, overflowX: 'auto'})
				.append($('<pre></pre>').append($(this).html()))
				
				var code_sample_content_holder = 
				$('<div></div>')
				.css({position: 'relative', height: 0, overflow: 'hidden'})
				.append(code_sample_content)
				
				var code_sample_main =
				$('<div class="code_sample"></div>')
				.css({position: 'relative'})
				.append(code_sample_content_holder)
				.append(
					$('<div class="button">view code sample</div>')
					.css({position: 'absolute', right: 0, top: -10})
					.click(function(){
						
						if(code_sample_content_holder.height() == 0)
						{
							$(this).html('hide code sample');
							code_sample_content_holder.animate({height: code_sample_content.outerHeight() + 10}, 500)
						}
						else
						{
							$(this).html('view code sample');
							code_sample_content_holder.animate({height: 0}, 500)
						}
						
					})
				)
				
				$(this).parent().append(code_sample_main);
			});
		},
		
		contactInProgress: false,
		
		contact: function()
		{
			if($.w.contactInProgress == false)
			{
				$.ajax({
					type: 'POST',
					url: '/contact/email',
					data: {
						name: $("#name").val(),
						email: $("#email").val(),
						subject: $("#subject").val(),
						message: $("#message").val(),
					},
					success: function(response)
					{
						$("#response").html(response.messages);
						
						setTimeout(function(){$("#response").html('')}, 5000);
						
						$("#name").val('');
						$("#email").val('');
						$("#subject").val('');
						$("#message").val('');
						
						$.w.contactInProgress = false;
					},
					dataType: "json"
				});
				
				$.w.contactInProgress = true;
			}
		}
	}
	
})(jQuery);

$(document).ready(function()
{  
	$.w.convert_to_code_sample();
});







