<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>S3Manage | <?php echo $title_for_layout; ?></title>
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.png" type="image/png">
    <?php echo $this->Html->css('styles');?>
</head>
<body class="error">
    <section id="middle">

        <article>
            <?php echo $this->fetch('content'); ?>
        </article>

        <!-- make the middle region's background color expand -->
        <div class="clear"></div>

    </section>

</body>
</html>