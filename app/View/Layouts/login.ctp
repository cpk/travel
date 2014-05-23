<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Login</title>
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

        <?php echo $content_for_layout ?>



        <!-- external javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <!-- jQuery -->
        <?php echo $this->Html->script('plugin/jquery-1.7.2.min'); ?>
        <!-- jQuery UI -->
        <?php echo $this->Html->script('plugin/jquery-ui-1.8.21.custom.min'); ?>
        <!-- transition / effect library -->
        <?php echo $this->Html->script('plugin/bootstrap-transition'); ?>
        <!-- alert enhancer library -->
        <?php echo $this->Html->script('plugin/bootstrap-alert'); ?>
        <!-- modal / dialog library -->
        <?php echo $this->Html->script('plugin/bootstrap-modal'); ?>
        <!-- custom dropdown library -->
        <?php echo $this->Html->script('plugin/bootstrap-dropdown'); ?>
        <!-- scrolspy library -->
        <?php echo $this->Html->script('plugin/bootstrap-scrollspy'); ?>
        <!-- library for creating tabs -->
        <?php echo $this->Html->script('plugin/bootstrap-tab'); ?>
        <!-- library for advanced tooltip -->
        <?php echo $this->Html->script('plugin/bootstrap-tooltip'); ?>
        <!-- popover effect library -->
        <?php echo $this->Html->script('plugin/bootstrap-popover'); ?>
        <!-- button enhancer library -->
        <?php echo $this->Html->script('plugin/bootstrap-button'); ?>
        <!-- accordion library (optional, not used in demo) -->
        <?php echo $this->Html->script('plugin/bootstrap-collapse'); ?>
        <!-- carousel slideshow library (optional, not used in demo) -->
        <?php echo $this->Html->script('plugin/bootstrap-carousel'); ?>
        <!-- autocomplete library -->
        <?php echo $this->Html->script('plugin/bootstrap-typeahead'); ?>
        <!-- tour library -->
        <?php echo $this->Html->script('plugin/bootstrap-tour'); ?>
        <!-- library for cookie management -->
        <?php echo $this->Html->script('plugin/jquery.cookie'); ?>
        <!-- calander plugin -->
        <?php echo $this->Html->script('plugin/fullcalendar.min.js'); ?>
        <!-- data table plugin -->
        <?php echo $this->Html->script('plugin/jquery.dataTables.min.js'); ?>

        <!-- chart libraries start -->
        <?php echo $this->Html->script('plugin/excanvas'); ?>
        <?php echo $this->Html->script('plugin/jquery.flot.min'); ?>
        <?php echo $this->Html->script('plugin/jquery.flot.pie.min'); ?>
        <?php echo $this->Html->script('plugin/jquery.flot.stack'); ?>
        <?php echo $this->Html->script('plugin/jquery.flot.resize.min'); ?>
        <!-- chart libraries end -->

        <!-- select or dropdown enhancer -->
        <?php echo $this->Html->script('plugin/jquery.chosen.min'); ?>
        <!-- checkbox, radio, and file input styler -->
        <?php echo $this->Html->script('plugin/jquery.uniform.min'); ?>
        <!-- plugin for gallery image view -->
        <?php echo $this->Html->script('plugin/jquery.colorbox.min'); ?>
        <!-- rich text editor library -->
        <?php echo $this->Html->script('plugin/jquery.cleditor.min'); ?>
        <!-- notification plugin -->
        <?php echo $this->Html->script('plugin/jquery.noty'); ?>
        <!-- file manager library -->
        <?php echo $this->Html->script('plugin/jquery.elfinder.min'); ?>
        <!-- star rating plugin -->
        <?php echo $this->Html->script('plugin/jquery.raty.min'); ?>
        <!-- for iOS style toggle switch -->
        <?php echo $this->Html->script('plugin/jquery.iphone.toggle'); ?>
        <!-- autogrowing textarea plugin -->
        <?php echo $this->Html->script('plugin/jquery.autogrow-textarea'); ?>
        <!-- multiple file upload plugin -->
        <?php echo $this->Html->script('plugin/jquery.uploadify-3.1.min'); ?>
        <!-- history.js for cross-browser state change on ajax -->
        <?php echo $this->Html->script('plugin/jquery.history'); ?>
        <!-- application script for Charisma demo -->
        <?php echo $this->Html->script('plugin/charisma'); ?>
    </body>
</html>
