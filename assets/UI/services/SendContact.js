$(document).ready(onSubmitContact);

function onSubmitContact() {
	
	$("#sendContact").on("click",function(ev){
		ev.preventDefault();
	});
	
	$("#newContact").on("click",function(ev){
		//this will prevent the page to reload when 
		//user clicks submit button
		ev.preventDefault();
		//remove previous alerts
		$("div[class~='alert']").remove();
		
		//set inputs objects via jquery
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
		
		// instantiate new contact object
		var EM = new Contact({
			name:name.val(),
			email:email.val(),
			message:message.val()
		});
		//switch between loading and submit buttons
		$("#newContact, #sendContact").toggle();
		
		// send request
		jXHR = EM.send(formData);
		jXHR.done(function(data, textStatus, resp) {//process successful response
			// show alerts
			$('#contact').before($(Alerts.parse(resp.responseJSON)).fadeIn(150));
			//remove alerts after 3 seconds
			$("div[class~='alert']").delay(3000).fadeOut("slow");
			//clean the form inputs
			$(name).val(''),$(email).val(''),$(phone).val(''),$(message).val('');
		})
		.fail(function(resp) {//handle failed result
			
			//show alerts
			$('#contact').before($(Alerts.parse(resp.responseJSON)).fadeIn(150));
			// remove alerts after 10 seconds
			$("div[class~='alert']").delay(10000).fadeOut("slow");
			//disable submit button
			$('#newContact').prop('disabled', true);
			setTimeout(function ()
			{//re-enable after 3 seconds
				$('#newContact').prop('disabled', false);
			}, 3000);
			
		});
		//switch between loading and submit buttons
		$("#newContact, #sendContact").toggle();
		
		//take client window to correct height in order for it to spot the alerts(in case of)
		window.location.hash = 'send';
		window.location.hash = 'form';


    
	});
}