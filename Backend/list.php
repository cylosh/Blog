<?php
define("TITLE", 'Admin Panel | Cylosh Blog');
define("HEADER_TITLE", 'Admin Panel');
define("HEADER_SUBTITLE", 'List Articles');
define("MENU_ACTIVE", 'apanel');

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include $this->GetTemplate('head'); ?>
<link rel="stylesheet" type="text/css" href="cached-assets/css/dataTables.bootstrap.min.css">
</head>

   <body>
		
<?php include $this->GetTemplate('header'); ?>
<?php include $this->GetTemplate('menu'); ?>

	<div>
		<div class="container">
		<?php if(isset($this->Alert)) print $this->Alert; ?>
		
			<table id="articles" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th style="width: 2%;">ID</th>
					<th>Title</th>
					<th>Date</th>
					<th style="width: 7%;">Edit</th>
					<th style="width: 7%;">Delete</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th style="width: 2%;">ID</th>
					<th>Title</th>
					<th>Date</th>
					<th style="width: 7%;">Edit</th>
					<th style="width: 7%;">Delete</th>
				</tr>
			</tfoot>
			<tbody>
				
				<?php
				foreach($this->Response['data'] as $article){
					if(!isset($article['Id']) || !isset($article['Title']) || !isset($article['Created']))
						continue;
					
					$id = htmlspecialchars($article['Id'], ENT_QUOTES, 'utf-8');
					$title = htmlspecialchars($article['Title'], ENT_QUOTES, 'utf-8');
					$url = htmlspecialchars($article['Url'], ENT_QUOTES, 'utf-8');
					if(!empty($url))
						$title = '<a href="'.$url.'">'.$title.'</a>';
						
					$date = htmlspecialchars($article['Created'], ENT_QUOTES, 'utf-8');
					$date = date('Y\-m\-j\ H\:i\:s', strtotime($date));
					echo '<tr>
					<td>'.$id.'</td>
					<td>'.$title.'</td>
					<td>'.$date.'</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="edit-'.$id.'" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="delete-'.$id.'" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>';
				}
				?>
			</tbody>
		</table>
		</div>
	</div>


    
	
      <!-- start:footer -->
<?php include $this->GetTemplate('footer'); ?>



	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,init.js"></script>
	<script src="assets/UI/models/Article.js"></script>
	<script src="assets/UI/services/SubmitArticle.js"></script>
	<script src="cached-assets/js/dataTables.min.js,dataTables.bootstrap.min.js"></script>
	<script type='text/javascript'>
		
		$(document).ready(function() {
			$('#articles').dataTable( {
  "pageLength": 50
} );
			
			$("[data-toggle=tooltip]").tooltip();

			
			$("#articles tbody").on("click","[data-target^=edit-]", function(){
				
				
			
				var ArticleId = $(this).data("target").split('-');
				
				window.location.href = '../backend/AddArticle?id='+ArticleId[1];
				
				
			});
			$("#articles tbody").on("click","[data-target^=delete-]", function(){
				var ArticleId = $(this).data("target").split('-');
				var deleteArt = confirm("Are you sure you want to delete article "+ArticleId[1]+"?");
				
				if (deleteArt == true) {
					window.location.href = '../backend/DeleteArticle?id='+ArticleId[1];
				}

			});
		} );
	</script>
	<!-- end:javascript -->
		
   </body>
</html>