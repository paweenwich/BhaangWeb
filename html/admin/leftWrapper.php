<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
?>
 <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">                          
				<li class="nav-header" style="padding:0;">
                    <div class="dropdown profile-element" style="padding-bottom: 10px;"> 
						<span><img alt="image" class="img-circle" src="img/logo.jpg" width="220" height="120"></span>     
                    </div>    
                </li>				
				<li>
                    <a href="welcome.php"><i class="fa fa-th-large"></i> <span class="nav-label">Home</span></a>
                </li>
				<li>
                    <a href="pickBlueprint.php"><i class="fa fa-plus"></i> <span class="nav-label">Create a Campaign</span></a>
                </li>
				<li>
                    <a href="myCampaigns.php"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">My Campaigns</span></a>
                </li>
				<li>
                    <a href="audiences.php"><i class="fa fa-address-book"></i> <span class="nav-label">Audiences</span></a>
                </li>
				<li>
                    <a href="accountSetting.php"><i class="fa fa-wrench"></i> <span class="nav-label">Account Setting</span></a>
                </li>
				<li>
                    <a href="helpCenter.php"><i class="fa fa-question-circle"></i> <span class="nav-label">Help Center & Live Chat</span></a>
                </li>
            </ul>
        </div>
    </nav>