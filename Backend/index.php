<?php
define("TITLE", 'Admin Panel | Cylosh Blog');
define("HEADER_TITLE", 'Admin Panel');
define("HEADER_SUBTITLE", 'Manage settings');
define("MENU_ACTIVE", 'apanel');

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include $this->GetTemplate('head'); ?>
<link rel="stylesheet" type="text/css" href="cached-assets/css/bootstrap-wysiwyg.css,fileinput.min.css">
</head>

   <body>
		
<?php include $this->GetTemplate('header'); ?>
<?php include $this->GetTemplate('menu'); ?>

	<div id="blank-page">
		<div class="container">
			
			<div class="container" id="error-ajax" style="display:none;"> <div class="alert alert-danger fade in" style="text-align:left;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span style="font-size:120%" id="error-ajax-message">Enter a valid Title</span>
			</div></div>

			<div class="container" id="error-title" style="display:none;"> <div class="alert alert-danger fade in" style="text-align:left;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span style="font-size:120%">Enter a valid Title</span>
			</div></div>

			<div class="container" id="error-content" style="display:none;"> <div class="alert alert-danger fade in" style="text-align:left;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span style="font-size:120%">Enter at least 100 characters for the article</span>
			</div></div>
			

			<div class="container" id="error-picture" style="display:none;"> <div class="alert alert-danger fade in" style="text-align:left;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;<span style="font-size:120%">Upload a picture for the article</span>
			</div></div>
			
			<?php if(isset($this->Response['Id'])) echo '<input type="hidden" id="articleID" value="'.$this->Response['Id'].'">';?>
			<h2>Article Title</h2>
			<div class="form-group col-md-8 col-xs-12"> <input class="form-control input-lg" placeholder="Name.." name="title" <?php if(isset($this->Response['Title'])) echo 'value="'.$this->Response['Title'].'"';?>> </div>
			<Br /><Br /><Br /><Br /><Br />
			
			<h2>Article Picture</h2>
<label class="control-label">Select File</label>
<input id="inputpic" name="inputpic[]" type="file" multiple class="file-loading">
			<Br /><Br /><Br /><Br /><Br />
			<?php if(isset($this->Response['ImgPath'])) echo '<img src="'.$this->Response['ImgPath'].'" style="max-height:400px;">';?>
			<h2>Article Content</h2>
			<div class="btn-toolbar" data-role="editor-toolbar"
				data-target="#editor">
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a data-edit="fontSize 5" class="fs-Five">Huge</a></li>
						<li><a data-edit="fontSize 3" class="fs-Three">Normal</a></li>
						<li><a data-edit="fontSize 1" class="fs-One">Small</a></li>
					</ul>
				</div>
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Text Highlight Color"><i class="fa fa-paint-brush"></i>&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<p>&nbsp;&nbsp;&nbsp;Text Highlight Color:</p>
                        <li><a data-edit="backColor #00FFFF">Blue</a></li>
						<li><a data-edit="backColor #00FF00">Green</a></li>
						<li><a data-edit="backColor #FF7F00">Orange</a></li>
						<li><a data-edit="backColor #FF0000">Red</a></li>
						<li><a data-edit="backColor #FFFF00">Yellow</a></li>
					</ul>
				</div>
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Color"><i class="fa fa-font"></i>&nbsp;<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<p>&nbsp;&nbsp;&nbsp;Font Color:</p>
						<li><a data-edit="foreColor #000000">Black</a></li>
                        <li><a data-edit="foreColor #0000FF">Blue</a></li>
                        <li><a data-edit="foreColor #30AD23">Green</a></li>
						<li><a data-edit="foreColor #FF7F00">Orange</a></li>
						<li><a data-edit="foreColor #FF0000">Red</a></li>
						<li><a data-edit="foreColor #FFFF00">Yellow</a></li>
					</ul>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
					<a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
					<a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
					<a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
					<a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
					<a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>
					<a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
					<a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
					<a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
					<a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
				</div>
				<div class="btn-group">
					<a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
					<div class="dropdown-menu input-append">
						<input placeholder="URL" type="text" data-edit="createLink" />
						<button class="btn" type="button">Add</button>
					</div>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>
					<span class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn"> <i class="fa fa-picture-o"></i>
						<input class="imgUpload" type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
					</span>
				</div>
				<div class="btn-group">
					<a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
					<a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
					<a class="btn btn-default" data-edit="clearformat" title="Clear Formatting" onClick="$('#editor').html($('#editor').text());"><i class='glyphicon glyphicon-fire'></i></a>
				</div>
			</div>
			<div id="editor" class="lead" data-placeholder="Write your new blog here"><?php if(isset($this->Response['Content'])) echo $this->Response['Content'];?></div>
			
			<p style="text-align: center;;">
				<a id="newArticle" class="btn btn-large btn-default jumbo" href="#" onclick="waitingDialog.show('Printing Article..', {dialogSize: 'm', progressType: 'primary'});">Submit</a>
			</p>
		</div>
	</div>
      
		
      <!-- start:footer -->
<?php include $this->GetTemplate('footer'); ?>



	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,owl.carousel.min.js,particles/winter.js,particles/min.js,particles/init.js,init.js,bookblock/modernizr.custom.js,bookblock/jquerypp.custom.min.js,bookblock/jquery.bookblock.js,bookblock/init.js"></script>
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
	<script src="assets/UI/models/Article.js"></script>
	<script src="assets/UI/services/SubmitArticle.js"></script>
	<script src="cached-assets/js/jquery.hotkeys.js,bootstrap-wysiwyg.min.js,plugins/canvas-to-blob.min.js,plugins/sortable.min.js,plugins/purify.min.js,fileinput.min.js,themes/fa/theme.js,waitingDialog.js"></script>
	<script type='text/javascript'>
		
		$('#editor').wysiwyg();
		
		$(".dropdown-menu > input").click(function (e) {
			e.stopPropagation();
		});
	</script>
	<script>

	$(document).on('ready', function() {
		$("#inputpic").fileinput({
			showUpload: false,
			maxFileCount: 10,
			mainClass: "input-group-lg"
		});
	});
	</script>
	<!-- end:javascript -->
		
   </body>
</html>