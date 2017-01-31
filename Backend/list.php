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

	<div id="blank-page">
		<div class="container">
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
				<tr>
					<td>1</td>
					<td>DDDDDDDDDDD</td>
					<td>2017-01-31 07:07:24</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>
				<tr>
					<td>1</td>
					<td>DDDDDDDDDDD</td>
					<td>2017-01-31 07:07:24</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>
				<tr>
					<td>1</td>
					<td>DDDDDDDDDDD</td>
					<td>2017-01-31 07:07:24</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>
				<tr>
					<td>1</td>
					<td>DDDDDDDDDDD</td>
					<td>2017-01-31 07:07:24</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>
				<tr>
					<td>1</td>
					<td>DDDDDDDDDDD</td>
					<td>2017-01-31 07:07:24</td>
    <td><p data-placement="left" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="edit-1" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="right" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
				</tr>
				
			</tbody>
		</table>
		</div>
	</div>


    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
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
			$('#articles').DataTable();
			
			$("[data-toggle=tooltip]").tooltip();
			$("[data-target^=edit-]").click(function(){
				var ArticleId = $(this).data("target").split('-');
				
				
				
			});
		} );
	</script>
	<!-- end:javascript -->
		
   </body>
</html>