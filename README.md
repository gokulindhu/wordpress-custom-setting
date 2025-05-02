# Wordpress-Customer-Banner-Setting

This WordPress plugin adds an admin settings page that allows site administrators to configure a customizable banner displayed on all pages. It includes options to toggle the banner, set the banner message, customize button text, and define a target URL for the button.

## Features

- Enable or disable the banner site-wide.
- Customize the banner message.
- Customize the button text and link.
- Simple integration using WordPress Settings API.

## Installation

1. Copy the PHP code into a file named `functions.php`.
2. Navigate to **Settings → Banner Toggle** to configure the settings.

## Usage

Once activated:

- Go to **Settings → Banner Toggle** in the WordPress admin dashboard.
- You’ll see the following options:
  - **Show Banner on All Pages**: Enable or disable the banner.
  - **Banner Message**: Set a custom message to display.
  - **Button Text**: Text for the call-to-action button.
  - **Button URL**: The link where the button redirects.

## Code Breakdown

### Hooks

```php
add_action('admin_menu', 'banner_settings_menu');
add_action('admin_init', 'banner_settings_init');
```

### Settings Page

```php
add_options_page('Banner Settings', 'Banner Toggle', 'manage_options', 'banner-settings', 'banner_settings_page');
```

### Settings Fields

- `show_banner`: Checkbox to toggle banner visibility.
- `banner_message`: Input for the banner message.
- `banner_button_text`: Input for the CTA button text.
- `banner_button_url`: Input for the CTA button URL.

## Example Default Values

- Banner Message: "Exciting offers. Don't miss out!"
- Button Text: "CLICK HERE"
- Button URL: "https://example.com"

## Customization

You can expand this setting to include:

- Frontend banner rendering logic.
- Styling using custom CSS.
- Conditional display (e.g., only on homepage).

## functions.php
- Add this code in functions.php
```php
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
    $value = get_option('banner_message', 'Exciting offers. Dont miss out');
    echo '<input required type="text" name="banner_message" value="' . esc_attr($value) . '" class="regular-text">';
}

function banner_button_text_callback() {
    $value = get_option('banner_button_text', 'CLICK HERE');
    echo '<input required type="text" name="banner_button_text" value="' . esc_attr($value) . '" class="regular-text">';
}

function banner_button_url_callback() {
    $value = get_option('banner_button_url', "https://example.com");
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
```

## header.php
- Add this code in header.php
```php
  <?php
if (get_option('show_banner') === 'on') {
	$btn_text = esc_html(get_option('banner_button_text', 'CLICK HERE'));
	$btn_url = esc_url(get_option('banner_button_url', 'https://example.com'));
	$banner_msg = esc_html(get_option('banner_message', 'Exciting offers. Dont miss out'));
	echo '<aside class="bg-secondary border-bottom">
                <strong class="text-white d-block lead mx-auto my-0 py-md-2 p-4" style="width: fit-content;">
                    ' . $banner_msg . ' 
                    <a class="btn btn-sm rounded btn-primary m-3 text-light" target="_blank" href="' . $btn_url . '">' . $btn_text . '</a>
                </strong>
            </aside>';
}
?>
```

## License

This project is licensed under the MIT License.