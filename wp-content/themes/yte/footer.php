
    <!-- Footer -->
    <div class="footer animated fadeIn">
      <div class="grid flex">
        <div class="block">

          <div class="col_12 textcenter">
            <div class="footer-logos hide-mobile">
              <?php dynamic_sidebar('footer-col'); ?>
            </div>

            <div class="footer-menu hide-mobile">
              <?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
            </div>
            <p>&copy; Copyrights 2016/17. <?php echo bloginfo('name'); ?>.  All rights reserved.</p>
          </div>

        </div>
      </div>
    </div>
    <!-- Footer -->

    <?php wp_footer(); ?>
  </body>
</html>
