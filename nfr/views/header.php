<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DSMG Monitoring</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <!-- plugin css-->
        <link href="<?php echo URL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/ionicons.css" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo URL;?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo URL;?>assets/app/css/app.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/alertify.core.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/alertify.bootstrap3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- js -->
        <script src="<?php echo URL;?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/alertify.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/bootstrapValidator.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/selectize.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/jquery.table2excel.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/app.js" type="text/javascript"></script>
    </head>
    <body class="skin-black">
        <header class="header">
            <a href="index.html" class="logo">
                DSMG Monitoring
            </a>
            <nav class="navbar navbar-fixed-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button" id="slide_menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                <?php if (Session::get('loggedIn') == true): ?>
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-red">
                                    <img src="<?php echo URL;?>assets/img/avatar.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php
                                        echo Session::get("name");
                                        echo "-".Session::get("designation");
                                        ?>
                                        <!--<small>Member since <?php echo date("jS F, Y", strtotime(Session::get("created"))); ?></small>-->
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo URL;?>admin/profile" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo URL;?>user_service/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <?php if (Session::get('loggedIn') == true): ?>
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo URL;?>assets/img/avatar.png" class="img-circle" alt="..." />
                        </div>
                        <div class="pull-left info">
                        	<small class="text-muted">Hello</small>
                            <p><?php echo strtok(Session::get("name"), ' ') ?></p>
                        </div>
                    </div>

                    <ul class="sidebar-menu">
<!--                         <li id="maintenance_schedules_li"> -->
                          <!--   <a href="<?php echo URL;?>admin/maintenance_roster"> -->
<!--                                 <i class="fa fa-th"></i> <span>Maintenance Roster</span> -->
<!--                             </a> -->
<!--                         </li> -->

                         <li id="maintenance_schedules_li">
                            <a href="<?php echo URL;?>admin/data_entry">
                                <i class="fa fa-th"></i> <span>Data Entry</span>
                            </a>
                        </li>
                        <li id="overdure_status_li">
                           <a href="<?php echo URL;?>admin/overdue_status">
                               <i class="fa fa-tag"></i> <span>Overdue Status</span>
                           </a>
                        </li>
                        <li id="crossing_inspection_li">
                           <a href="<?php echo URL;?>admin/crossing_inspection">
                               <i class="fa fa-tag"></i> <span>Joint Point/Crossing</span>
                           </a>
                        </li>
                        <?php if (Session::get('user_type') == 'admin'): ?>
                          <li id="reports_li" class="treeview">
                            <a href="#">
                                <i class="fa fa-copy"></i>
                                <span>Report</span>
                                 <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" id="reports_sub_li">
                            	<li id="user_report_li"><a href="<?php echo URL;?>admin/reports_station_wise"><i class="fa fa-angle-double-right"></i> Station Wise</a></li>
                            	<li id="station_report_li"><a href="<?php echo URL;?>admin/reports_gear_wise"><i class="fa fa-angle-double-right"></i> Gear Wise</a></li>
                            	<li id="gear_report_li"><a href="<?php echo URL;?>admin/reports_schedule_wise"><i class="fa fa-angle-double-right"></i> Schedule Wise</a></li>
                            </ul>
                        </li>

                        <li  id="setting_li" class="treeview">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Master Data</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" id="setting_sub_ul">
                            	 <li id="station_master_li"><a href="<?php echo URL;?>admin/station_master"><i class="fa fa-road"></i> Stations Master</a></li>
                               <li id="schedule_master_li"><a href="<?php echo URL;?>admin/schedule_master"><i class="fa fa-tag"></i> Schedule Code Master</a></li>
                               <li id="gear_type_master_li"><a href="<?php echo URL;?>admin/gear_type_master"><i class="fa fa-gears"></i> Gear Types Master</a></li>
                       			   <li id="gear_master_li"><a href="<?php echo URL;?>admin/gear_master"><i class="fa fa-gear"></i>Station Gear Master</a></li>
                               <li id="user_msater_li"><a href="<?php echo URL;?>admin/user_msater"><i class="fa fa-user"></i> User Master</a></li>

                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </section>
                <?php endif; ?>
            </aside>
            <script type="text/javascript">
            $(function(){
            	var user_type = "<?php echo Session::get('user_type'); ?>";
            	if(user_type == "user"){$('#slide_menu').click().hide();}
            });
            </script>
