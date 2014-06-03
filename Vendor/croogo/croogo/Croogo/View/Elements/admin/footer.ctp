<footer class="navbar-inverse">
    <div class="navbar-inner">

        <div class="footer-content">
            <?php
            $link = $this->Html->link(
                __d('SME', 'Sony Music Entertainment'),
                'http://www.sonymusic.de'
            );

            $year = Date("Y");
            ?>
            <?php echo '&copy;';?>
            <?php echo $year; ?>
            <?php echo $link; ?>
        </div>

    </div>
</footer>