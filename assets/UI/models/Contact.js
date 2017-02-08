function Contact(options) {
    this.id = options.id;
    this.name = options.name;
    this.email = options.email;
    this.message = options.message;
}


Contact.prototype.send = function(formData){
	
    return $.ajax({
        url:$('#contact').attr('action')+'?json',
        type:"POST",
        data:formData,
        processData:false,
        contentType: false,
        dataType : "json",
    });
}
