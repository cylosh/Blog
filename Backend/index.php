<?php
define("TITLE", 'Admin Panel | Cylosh Blog');
define("HEADER_TITLE", 'Admin Panel');
define("HEADER_SUBTITLE", 'Manage settings');
define("MENU_ACTIVE", 'admin');

?><!DOCTYPE html>
<html lang="en">
<head>
<?php include $this->GetTemplate('head'); ?>
</head>

   <body>
		
<?php include $this->GetTemplate('header'); ?>
<?php include $this->GetTemplate('menu'); ?>

	<div id="blank-page">
		<div class="container">
			<div class="box-blank-page">
				<p>This is blank page.</p>
			</div>
		</div>
	</div>
      
		
      <!-- start:footer -->
<?php include $this->GetTemplate('footer'); ?>



	<!-- start:javascript -->
	<script src="cached-assets/js/jquery-1.11.1.min.js,bootstrap.min.js,owl.carousel.min.js,particles/winter.js,particles/min.js,particles/init.js,init.js,bookblock/modernizr.custom.js,bookblock/jquerypp.custom.min.js,bookblock/jquery.bookblock.js,bookblock/init.js"></script>
	<!-- end:javascript -->
		
   </body>
</html>