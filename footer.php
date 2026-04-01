<?php
/**
 * Master footer wrapper.
 * Loads the real three‑column footer and then fires wp_footer().
 */
get_template_part( 'template-parts/footers/footer', 'default' );

wp_footer();               // ‼️ required for plugins / scripts
?>
</body>
</html>
