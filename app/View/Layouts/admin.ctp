<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>Administrator | <?php echo $title_for_layout; ?></title>
        <link rel="icon" href="/favicon.png" type="image/png">
        <meta charset="utf-8">
        <title>Free HTML5 Bootstrap Admin Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
        <meta name="author" content="Muhammad Usman">

        <!-- The styles -->
        <?php echo $this->Html->css('bootstrap-cerulean.css'); ?>
        <style type="text/css">
            body {
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <?php echo $this->Html->css('bootstrap-responsive.css'); ?>
        <?php echo $this->Html->css('charisma-app.css'); ?>
        <?php echo $this->Html->css('jquery-ui-1.8.21.custom.css'); ?>
        <?php echo $this->Html->css('fullcalendar.css'); ?>
        <?php echo $this->Html->css('fullcalendar.print.css'); ?>
        <?php echo $this->Html->css('chosen.css'); ?>
        <?php echo $this->Html->css('uniform.default.css'); ?>
        <?php echo $this->Html->css('colorbox.css'); ?>
        <?php echo $this->Html->css('jquery.cleditor.css'); ?>
        <?php echo $this->Html->css('jquery.noty.css'); ?>
        <?php echo $this->Html->css('noty_theme_default.css'); ?>
        <?php echo $this->Html->css('elfinder.min.css'); ?>
        <?php echo $this->Html->css('elfinder.theme.css'); ?>
        <?php echo $this->Html->css('jquery.iphone.toggle.css'); ?>
        <?php echo $this->Html->css('opa-icons.css'); ?>
        <?php echo $this->Html->css('uploadify.css'); ?>
    </head>
    <body>
        <!-- topbar starts -->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'index')); ?>"> <?php echo $this->Html->image('logo20.png', array('alt' => 'cpk')); ?> <span>CPK</span></a>

                    <!-- theme selector starts -->
                    <div class="btn-group pull-right theme-container" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-tint"></i><span class="hidden-phone"> Change Theme / Skin</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" id="themes">
                            <li><a data-value="classic" href="#"><i class="icon-blank"></i> Classic</a></li>
                            <li><a data-value="cerulean" href="#"><i class="icon-blank"></i> Cerulean</a></li>
                            <li><a data-value="cyborg" href="#"><i class="icon-blank"></i> Cyborg</a></li>
                            <li><a data-value="redy" href="#"><i class="icon-blank"></i> Redy</a></li>
                            <li><a data-value="journal" href="#"><i class="icon-blank"></i> Journal</a></li>
                            <li><a data-value="simplex" href="#"><i class="icon-blank"></i> Simplex</a></li>
                            <li><a data-value="slate" href="#"><i class="icon-blank"></i> Slate</a></li>
                            <li><a data-value="spacelab" href="#"><i class="icon-blank"></i> Spacelab</a></li>
                            <li><a data-value="united" href="#"><i class="icon-blank"></i> United</a></li>
                        </ul>
                    </div>
                    <!-- theme selector ends -->

                    <!-- user dropdown starts -->
                    <div class="btn-group pull-right" >
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user"></i><span class="hidden-phone"> admin</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div>
                    <!-- user dropdown ends -->

                    <div class="top-nav nav-collapse">
                        <ul class="nav">
                            <li><a href="#">Visit Site</a></li>
                            <li>
                                <form class="navbar-search pull-left">
                                    <input placeholder="Search" class="search-query span2" name="query" type="text">
                                </form>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- topbar ends -->
        <div class="container-fluid">
            <div class="row-fluid">

                <!-- left menu starts -->
                <div class="span2 main-menu-span">
                    <div class="well nav-collapse sidebar-nav">
                        <ul class="nav nav-tabs nav-stacked main-menu">
                            <li class="nav-header hidden-tablet">Main</li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'catalogs1')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Catalogs level 1 </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'catalogs2')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Catalogs level 2 </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'catalogs3')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Catalogs level 3 </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'items')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> News </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'galleries')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Galleries </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'users')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Users </span></a></li> 
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'lists', 'advertisings')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Advertisings </span></a></li>
                            <li class="nav-header hidden-tablet">System</li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'backup')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Backup</span></a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'admin', 'action' => 'restore')); ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Restore</span></a></li>
                        </ul>
                        <label id="for-is-ajax" class="hidden-tablet" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>
                    </div><!--/.well -->
                </div><!--/span-->
                <!-- left menu ends -->

                <noscript>
                <div class="alert alert-block span10">
                    <h4 class="alert-heading">Warning!</h4>
                    <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
                </div>
                </noscript>

                <div id="content" class="span10">
                    <?php echo $content_for_layout ?>
                    <!-- make the middle region's background color expand -->
                    <div class="clear"></div>                    
                </div><!--/#content.span10-->
            </div><!--/fluid-row-->

            <hr>

            <div class="modal hide fade" id="myModal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary">Save changes</a>
                </div>
            </div>

            <footer>
                <p class="pull-right">Copyright &copy; <a href="http://cpk.vn" target="_blank">CPK</a> 2014</p>
                
            </footer>

        </div><!--/.fluid-container-->

        <!-- external javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script type='text/javascript'> var webroot = "<?php echo $webroot; ?>"; </script>
        <!-- jQuery -->
        <?php echo $this->Html->script('jquery-1.7.2.min'); ?>
        <!-- jQuery UI -->
        <?php echo $this->Html->script('jquery-ui-1.8.21.custom.min'); ?>
        <!-- transition / effect library -->
        <?php echo $this->Html->script('bootstrap-transition'); ?>
        <!-- alert enhancer library -->
        <?php echo $this->Html->script('bootstrap-alert'); ?>
        <!-- modal / dialog library -->
        <?php echo $this->Html->script('bootstrap-modal'); ?>
        <!-- custom dropdown library -->
        <?php echo $this->Html->script('bootstrap-dropdown'); ?>
        <!-- scrolspy library -->
        <?php echo $this->Html->script('bootstrap-scrollspy'); ?>
        <!-- library for creating tabs -->
        <?php echo $this->Html->script('bootstrap-tab'); ?>
        <!-- library for advanced tooltip -->
        <?php echo $this->Html->script('bootstrap-tooltip'); ?>
        <!-- popover effect library -->
        <?php echo $this->Html->script('bootstrap-popover'); ?>
        <!-- button enhancer library -->
        <?php echo $this->Html->script('bootstrap-button'); ?>
        <!-- accordion library (optional, not used in demo) -->
        <?php echo $this->Html->script('bootstrap-collapse'); ?>
        <!-- carousel slideshow library (optional, not used in demo) -->
        <?php echo $this->Html->script('bootstrap-carousel'); ?>
        <!-- autocomplete library -->
        <?php echo $this->Html->script('bootstrap-typeahead'); ?>
        <!-- tour library -->
        <?php echo $this->Html->script('bootstrap-tour'); ?>
        <!-- library for cookie management -->
        <?php echo $this->Html->script('jquery.cookie'); ?>
        <!-- calander plugin -->
        <?php echo $this->Html->script('fullcalendar.min.js'); ?>
        <!-- data table plugin -->
        <?php echo $this->Html->script('jquery.dataTables.min.js'); ?>

        <!-- chart libraries start -->
        <?php echo $this->Html->script('excanvas'); ?>
        <?php echo $this->Html->script('jquery.flot.min'); ?>
        <?php echo $this->Html->script('jquery.flot.pie.min'); ?>
        <?php echo $this->Html->script('jquery.flot.stack'); ?>
        <?php echo $this->Html->script('jquery.flot.resize.min'); ?>
        <!-- chart libraries end -->

        <!-- select or dropdown enhancer -->
        <?php echo $this->Html->script('jquery.chosen.min'); ?>
        <!-- checkbox, radio, and file input styler -->
        <?php echo $this->Html->script('jquery.uniform.min'); ?>
        <!-- plugin for gallery image view -->
        <?php echo $this->Html->script('jquery.colorbox.min'); ?>
        <!-- rich text editor library -->
        <?php echo $this->Html->script('jquery.cleditor.min'); ?>
        <!-- notification plugin -->
        <?php echo $this->Html->script('jquery.noty'); ?>
        <!-- file manager library -->
        <?php echo $this->Html->script('jquery.elfinder.min'); ?>
        <!-- star rating plugin -->
        <?php echo $this->Html->script('jquery.raty.min'); ?>
        <!-- for iOS style toggle switch -->
        <?php echo $this->Html->script('jquery.iphone.toggle'); ?>
        <!-- autogrowing textarea plugin -->
        <?php echo $this->Html->script('jquery.autogrow-textarea'); ?>
        <!-- multiple file upload plugin -->
        <?php echo $this->Html->script('jquery.uploadify-3.1.min'); ?>
        <!-- history.js for cross-browser state change on ajax -->
        <?php echo $this->Html->script('jquery.history'); ?>
        <!-- application script for Charisma demo -->
        <?php echo $this->Html->script('charisma'); ?>
        <!-- application script for Admin -->
        <?php echo $this->Html->script('admin'); ?>
    </body>
</html>
