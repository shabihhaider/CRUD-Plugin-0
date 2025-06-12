<?php
// Prevent direct access
defined('ABSPATH') || exit;
?>

<div class="wrap mmp-settings-wrap">
    <h1 class="mmp-title"><?php _e('Maintenance Mode Settings', 'maintenance-mode'); ?></h1>

    <form method="post" action="options.php" class="mmp-settings-form">
        <?php
        settings_fields('mmp_settings');
        do_settings_sections('maintenance-mode');
        submit_button(__('💾 Save Settings', 'maintenance-mode'), 'primary', 'submit', true, ['class' => 'mmp-button']);
        ?>
    </form>

    <div class="mmp-preview-box">
        <h2>Preview</h2>
        <div class="mmp-preview-message">
            <?php echo esc_html(get_option('mmp_message', 'This site is currently under maintenance. Please check back later.')); ?>
        </div>
    </div>
</div>
