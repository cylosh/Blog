$(document).ready(onSubmitContact);

function onSubmitContact() {
	
	$("#sendContact").on("click",function(ev){
		ev.preventDefault();
	});
	
	$("#newContact").on("click",function(ev){
		//this will prevent the page to reload when 
		//user clicks submit button
		ev.preventDefault();
		
		$("div[class~='alert']").remove();
		
		var name = $("input[name='name']");
		var email = $("input[name='email']");
		var phone = $("input[name='phone']");
		var message = $("textarea[name='message']");
		
		//prepare the form data to be sent to server
		var formData = new FormData();
		formData.append("name",name.val());
		formData.append("email",email.val());
		formData.append("phone",phone.val());
		formData.append("message",message.val());
		
		var EM = new Contact({
			name:name.val(),
			email:email.val(),
			message:message.val()
		});
		
		$("#newContact, #sendContact").toggle();

		jXHR = EM.send(formData);
		jXHR.done(function(data, textStatus, resp) {
			$('#contact').before($(Alerts.parse(resp.responseJSON)).fadeIn(150));
			console.log(resp);
			console.log(resp.responseJSON);
			$("div[class~='alert']").delay(3000).fadeOut("slow");
	
			$(name).val(''),$(email).val(''),$(phone).val(''),$(message).val('');
		})
		.fail(function(resp) {
			
			$('#contact').before($(Alerts.parse(resp.responseJSON)).fadeIn(150));
			
			$("div[class~='alert']").delay(10000).fadeOut("slow");

			$('#newContact').prop('disabled', true);
			setTimeout(function ()
			{
				$('#newContact').prop('disabled', false);
			}, 3000);
			
		});
		
		$("#newContact, #sendContact").toggle();
		window.location.hash = 'send';
		window.location.hash = 'form';


    
	});
}