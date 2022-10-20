<?php

/**
 * Admin area view for the plugin
 *
 * @link       https://faithinmarketing.com
 * @since      2.0.0
 *
 * @package    FIM_Ministries
 * @subpackage FIM_Ministries/admin/partials
 */
?>

<!-- SETTINGS PAGE -->
<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <form action="options.php" method="post">
        <?php
            settings_fields( $this->plugin_name);
            do_settings_sections( $this->plugin_name );
            submit_button();
        ?>
    </form>
</div>
