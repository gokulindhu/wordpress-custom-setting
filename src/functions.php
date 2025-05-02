<?php
// Register settings menu and setting
add_action('admin_menu', 'banner_settings_menu');
add_action('admin_init', 'banner_settings_init');
// 1. Add a settings page under "Settings"
function banner_settings_menu() {
    add_options_page(
        'Banner Settings',
        'Banner Toggle',
        'manage_options',
        'banner-settings',
        'banner_settings_page'
    );
}

// 2. Register the setting and field
function banner_settings_init() {
    register_setting('banner_settings_group', 'show_banner');
	register_setting('banner_settings_group', 'banner_message');
    register_setting('banner_settings_group', 'banner_button_text');
    register_setting('banner_settings_group', 'banner_button_url');

    add_settings_section(
        'banner_settings_section',
        'Banner Display Setting',
        null,
        'banner-settings'
    );

    add_settings_field(
        'show_banner',
        'Show Banner on All Pages',
        'banner_toggle_field_callback',
        'banner-settings',
        'banner_settings_section'
    );
	add_settings_field(
        'banner_message',
        'Banner Message',
        'banner_message_callback',
        'banner-settings',
        'banner_settings_section'
    );

	add_settings_field(
        'banner_button_text',
        'Button Text',
        'banner_button_text_callback',
        'banner-settings',
        'banner_settings_section'
    );

    add_settings_field(
        'banner_button_url',
        'Button URL',
        'banner_button_url_callback',
        'banner-settings',
        'banner_settings_section'
    );
}


// 3. Render the toggle field and other field
function banner_toggle_field_callback() {
    $value = get_option('show_banner', 'off');
    $checked = ($value === 'on') ? 'checked' : '';
    echo '<label><input type="checkbox" name="show_banner" value="on" ' . $checked . '> Enable Banner</label>';
}
function banner_message_callback() {
    $value = get_option('banner_message', 'DONATE TO CALIFORNIA WILDFIRE RELIEF');
    echo '<input required type="text" name="banner_message" value="' . esc_attr($value) . '" class="regular-text">';
}

function banner_button_text_callback() {
    $value = get_option('banner_button_text', 'GIVE NOW');
    echo '<input required type="text" name="banner_button_text" value="' . esc_attr($value) . '" class="regular-text">';
}

function banner_button_url_callback() {
    $value = get_option('banner_button_url', 'https://example.com');
    echo '<input required type="url" name="banner_button_url" value="' . esc_attr($value) . '" class="regular-text">';
}

// 4. Render the settings page
function banner_settings_page() {
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <?php
                settings_fields('banner_settings_group');
                do_settings_sections('banner-settings');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}
?>