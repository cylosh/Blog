<!-- start:navbar -->
<nav class="navbar navbar-default navbar-static-top">
   <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="./"><strong><i class="fa fa-sun-o"></i> Cyberlinks Open Source</strong></a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse navbar-ex1-collapse">
         <ul class="nav navbar-nav">
            
            <li <?php if(defined("MENU_ACTIVE") && MENU_ACTIVE == 'index') echo 'class="active"'; ?>><a href="./">HOME</a></li>
            <li <?php if(defined("MENU_ACTIVE") && MENU_ACTIVE == 'about') echo 'class="active"'; ?>><a href="about">ABOUT</a></li>
            <li <?php if(defined("MENU_ACTIVE") && MENU_ACTIVE == 'contact') echo 'class="active"'; ?>><a href="contact">CONTACT</a></li>
            
            <li class="dropdown">
               <a href="#"  class="dropdown-toggle" data-toggle="dropdown">LINKS <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li><a href="resources.html">RESOURCES</a></li>
               </ul>
            </li>
			<li class="dropdown <?php if(defined("MENU_ACTIVE") && MENU_ACTIVE == 'apanel') echo 'active'; ?>">
               <a href="#" class="dropdown-toggle active" data-toggle="dropdown">ADMIN PANEL <b class="caret"></b></a>
               <ul class="dropdown-menu">
                  <li><a href="backend">NEW BLOG</a></li>
                  <li><a href="backend/listArticles">ARTICLES</a></li>
               </ul>
            </li>
         </ul>
		
         <form class="navbar-form navbar-right" role="search">
            <div class="input-group">
			
               <input type="text" class="form-control" placeholder="Search">
               <span class="input-group-btn">
               <button class="btn btn-default" type="button">Go!</button>
               </span>
			
            </div>
			<div class="input-group">
			<button type="submit" class="btn btn-link "><a href="login/out">LOG OUT <span class="glyphicon glyphicon glyphicon-log-out" aria-hidden="true"></span>
</a></button>	
			</div>
         </form>
      </div>
      <!-- /.navbar-collapse -->
   </div>
</nav>
<!-- end:navbar -->