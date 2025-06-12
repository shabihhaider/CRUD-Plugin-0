<?php

// Only define the class if it doesn't already exist
if (!class_exists('MMP_MaintenanceMode')) {
    class MMP_MaintenanceMode {

        public function __construct() {
            add_action('admin_menu', [$this, 'mmp_add_admin_menus']);
            add_action('admin_init', [$this, 'mmp_register_settings']);
            add_action('template_redirect', [$this, 'mmp_handle_maintenance_mode']);
            add_action('admin_enqueue_scripts', [$this, 'mmp_enqueue_admin_assets']);
        }

        public function mmp_add_admin_menus() {
            add_menu_page(
                __('Maintenance Mode', 'maintenance-mode'),   // Page title
                __('Maintenance Mode', 'maintenance-mode'),   // Menu title
                'manage_options',                             // Capability
                'maintenance-mode',                           // Slug
                [$this, 'mmp_render_settings_page'],                // Callback
                'dashicons-admin-tools',                      // Dashicon
                80                                            // Position (optional)
            );
        }

        public function mmp_register_settings() {
            register_setting('mmp_settings', 'mmp_enabled', [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ]);

            register_setting('mmp_settings', 'mmp_message', [
                'type' => 'string',
                'sanitize_callback' => 'sanitize_textarea_field',
            ]);

            // Register logo and background image
            register_setting('mmp_settings', 'mmp_logo_url', [
                'type' => 'string',
                'sanitize_callback' => 'esc_url_raw',
            ]);

            register_setting('mmp_settings', 'mmp_bg_url', [
                'type' => 'string',
                'sanitize_callback' => 'esc_url_raw',
            ]);

            add_settings_section('mmp_section', __('Settings', 'maintenance-mode'), null, 'maintenance-mode');

            add_settings_field(
                'mmp_enabled',
                __('Enable Maintenance Mode', 'maintenance-mode'),
                [$this, 'mmp_render_enable_field'],
                'maintenance-mode',
                'mmp_section'
            );

            add_settings_field(
                'mmp_message',
                __('Custom Message', 'maintenance-mode'),
                [$this, 'mmp_render_message_field'],
                'maintenance-mode',
                'mmp_section'
            );

            add_settings_field(
                'mmp_logo_url',
                __('Logo Image', 'maintenance-mode'),
                [$this, 'mpp_render_logo_field'],
                'maintenance-mode',
                'mmp_section'
            );

            add_settings_field(
                'mmp_bg_url',
                __('Background Image', 'maintenance-mode'),
                [$this, 'mpp_render_background_field'],
                'maintenance-mode',
                'mmp_section'
            );
        }

        public function mpp_render_logo_field() {
            $logo = esc_url(get_option('mmp_logo_url'));
            echo '<input type="text" id="mmp_logo_url" name="mmp_logo_url" value="' . $logo . '" style="width:60%;" />';
            echo '<button class="button mmp-media-upload" data-target="mmp_logo_url">Upload</button>';
        }

        public function mpp_render_background_field() {
            $bg = esc_url(get_option('mmp_bg_url'));
            echo '<input type="text" id="mmp_bg_url" name="mmp_bg_url" value="' . $bg . '" style="width:60%;" />';
            echo '<button class="button mmp-media-upload" data-target="mmp_bg_url">Upload</button>';
        }

        public function mmp_render_enable_field() {
            $enabled = get_option('mmp_enabled');
            echo '<input type="checkbox" name="mmp_enabled" value="on" ' . checked($enabled, 'on', false) . ' />';
        }

        public function mmp_render_message_field() {
            $message = get_option('mmp_message', 'This site is currently under maintenance. Please check back later.');
            echo '<textarea name="mmp_message" rows="4" cols="50">' . esc_textarea($message) . '</textarea>';
        }

        public function mmp_render_settings_page() {
            include MM_PLUGIN_PATH . 'pages/settings-page.php';
        }

        public function mmp_enqueue_admin_assets() {
            $screen = get_current_screen();
            
            if (strpos($screen->id, 'maintenance-mode') !== false) {
                wp_enqueue_style('mmp-style', MM_PLUGIN_URL . 'assets/css/style.css', [], '1.0.0');
                wp_enqueue_script('mmp-script', MM_PLUGIN_URL . 'assets/js/script.js', ['jquery'], '1.0.0', true);
                wp_enqueue_media(); // Required for media uploader
            }
        }


        public function mmp_handle_maintenance_mode() {
            if (is_user_logged_in() && current_user_can('edit_posts')) return;
            if (is_admin() || defined('DOING_AJAX') || defined('REST_REQUEST')) return;
            
            $logo = esc_url(get_option('mmp_logo_url', MM_PLUGIN_URL . 'assets/images/logo1.jpeg'));
            $bg = esc_url(get_option('mmp_bg_url', ''));


            $enabled = get_option('mmp_enabled');
            if ($enabled === 'on') {
                $message = get_option('mmp_message', 'This site is currently under maintenance. Please check back later.');

                // Full custom HTML layout
                echo '<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Maintenance Mode</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 0;
                            background: url("' . $bg . '") no-repeat center center fixed;
                            background-size: cover;
                            font-family: "Segoe UI", sans-serif;
                            color: #000;
                            text-align: center;
                        }
                        .mmp-container {
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            height: 100vh;
                            flex-direction: column;
                            padding: 20px;
                        }
                        .mmp-logo {
                            max-width: 150px;
                            margin-bottom: 30px;
                        }
                        .mmp-message {
                            font-size: 24px;
                            margin-bottom: 20px;
                            animation: fadeIn 1s ease-in-out;
                        }
                        #mmp-countdown {
                            font-size: 20px;
                            font-weight: bold;
                            animation: fadeIn 1.5s ease-in-out;
                        }
                        @keyframes fadeIn {
                            from { opacity: 0; transform: translateY(20px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                    </style>
                </head>
                <body>
                    <div class="mmp-container">
                        <img src="' . $logo . '" alt="Site Logo" class="mmp-logo" style="border-radius: 50%; width: 150px;" />
                        <div class="mmp-message">' . esc_html($message) . '</div>
                        <div id="mmp-countdown">We\'ll be back in: <span id="countdown-timer">00:10:00</span></div>
                    </div>
                    <script>
                        // Basic countdown from 10 minutes
                        let time = 600;
                        const timerElement = document.getElementById("countdown-timer");

                        function updateCountdown() {
                            const minutes = String(Math.floor(time / 60)).padStart(2, "0");
                            const seconds = String(time % 60).padStart(2, "0");
                            timerElement.textContent = `${minutes}:${seconds}`;
                            time--;
                            if (time >= 0) setTimeout(updateCountdown, 1000);
                        }
                        updateCountdown();
                    </script>
                </body>
                </html>';
                exit;
            }
        }

    }
}