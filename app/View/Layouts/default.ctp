<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>S3Manage | <?php echo $title_for_layout; ?></title>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.png" type="image/png">
    </head>
    <body>
        <header id="header">Header
        </header>

        <nav id="navbar">
            Navbar
        </nav>

        <section id="middle">

            <article id="main">
                <?php echo $this->fetch('content'); ?>
            </article>

            <!-- make the middle region's background color expand -->
            <div class="clear"></div>

        </section>

        <footer id="footer">
            Footer
        </footer>

    </body>
</html>