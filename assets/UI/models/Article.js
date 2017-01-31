function Article(options) {
    this.id = options.id;
    this.user_id = options.user_id;
    this.url = options.url;
    this.title = options.title;
    this.content = options.content;
    this.tags = options.tags;
    this.likes = options.likes;
    this.img_frame = options.img_frame;
    this.modified = options.modified;
    this.created = options.created;
}

Article.prototype.add = function(formData){

	setTimeout(function(){waitingDialog.hide();}, 5000);
	
    //ajax requst to save article goes here
    $.ajax({
        url:"../api/backend/AddArticle",
        type:"POST",
        data:formData,
        processData:false,
        contentType: false,
        success: function(resp) {
            if ( resp.successURL != undefined && resp.successURL.length ) {
				window.location.href = resp.successURL;
			}
        },
        error: function(resp){
            var response = JSON.parse(resp.responseText);
			$('#error-ajax').show();
			$('#error-ajax-message').show();
			$('#error-ajax-message').html(response.error.alert);
			console.log(response.error.alert);
        }
    }).complete(function() {
		waitingDialog.hide();
	})
}