/* global $*/
$(document).ready(onSubmitArticle);

function onSubmitArticle() {
    var articleSubmit = $("#newArticle");
	
	
    articleSubmit.on("click",function(ev){
        //this will prevent the page to reload when 
        //user clicks submit button
        ev.preventDefault();
		$('[id^=error-').hide();
		
        //~ //extract input data
        var titleText = $("input[name='title']").val();
        var articleID = $('#articleID').val();
        var contentText = $('#editor').html();
        var articleImgElem = $("#inputpic");
		
        var files = articleImgElem[0].files;
        var articleImg = files[0];
		
		if(titleText.length < 5){
			waitingDialog.hide();
			
			$('#error-title').toggle(500, 'linear', function(){
				window.location.hash = '#error-title';
				setTimeout(function(){$('#error-title').hide();}, 5000);
			});
			return;
		}
		if(contentText.length < 100){
			waitingDialog.hide();
			$('#error-content').toggle(500, 'linear', function(){
				window.location.hash = '#error-content';
				setTimeout(function(){$('#error-content').hide();}, 5000);
			});
			return;
		}
		
		
        //prepare the form data to be sent to server
        var formData = new FormData();
		if(articleID != undefined && articleID.length >0){
			formData.append("id", articleID);
		}
        formData.append("title",titleText);
        formData.append("content",contentText);
        formData.append("file",articleImg);
        
        var article = new Article({
            title:titleText,
            content:contentText,
            image:articleImg
        })
        article.add(formData);
    });
}