<?php
add_action('admin_menu', 'avelica_ws_support_add_admin_menu');
add_action('admin_init', 'avelica_ws_support_settings_init');

function avelica_ws_support_add_admin_menu()
{

    add_options_page('Avelica Support Plugin', 'Avelica Support Plugin', 'manage_options', 'wp_avelica_support_plugin', 'avelica_ws_support_options_page');

}

function avelica_ws_support_settings_init()
{

    register_setting('pluginPage', 'avelica_ws_support_settings');

    add_settings_section(
        'avelica_ws_support_pluginPage_section',
        __('Your section description', 'avelica-support'),
        'avelica_ws_support_settings_section_callback',
        'pluginPage'
    );

    add_settings_field(
        'avelica_ws_support_licence',
        __('Settings field description', 'avelica-support'),
        'avelica_ws_support_licence_render',
        'pluginPage',
        'avelica_ws_support_pluginPage_section'
    );

    add_settings_field(
        'avelica_ws_support_textarea_field_1',
        __('Settings field description', 'avelica-support'),
        'avelica_ws_support_textarea_field_1_render',
        'pluginPage',
        'avelica_ws_support_pluginPage_section'
    );

    add_settings_field(
        'avelica_ws_support_checkbox_field_2',
        __('Settings field description', 'avelica-support'),
        'avelica_ws_support_checkbox_field_2_render',
        'pluginPage',
        'avelica_ws_support_pluginPage_section'
    );

    add_settings_field(
        'avelica_ws_support_checkbox_field_3',
        __('Settings field description', 'avelica-support'),
        'avelica_ws_support_checkbox_field_3_render',
        'pluginPage',
        'avelica_ws_support_pluginPage_section'
    );

    add_settings_field(
        'avelica_ws_support_checkbox_field_4',
        __('Settings field description', 'avelica-support'),
        'avelica_ws_support_checkbox_field_4_render',
        'pluginPage',
        'avelica_ws_support_pluginPage_section'
    );

}

function avelica_ws_support_licence_render()
{

    $options = get_option('avelica_ws_support_settings');
    ?>
<input type='password' name='avelica_ws_support_settings[avelica_ws_support_licence]'
    value='<?php echo $options['avelica_ws_support_licence']; ?>'>
<?php

}

function avelica_ws_support_textarea_field_1_render()
{

    $options = get_option('avelica_ws_support_settings');
    ?>
<textarea cols='40' rows='5' name='avelica_ws_support_settings[avelica_ws_support_textarea_field_1]'>
		<?php echo $options['avelica_ws_support_textarea_field_1']; ?>
 	</textarea>
<?php

}

function avelica_ws_support_checkbox_field_2_render()
{

    $options = get_option('avelica_ws_support_settings');
    ?>
<input type='checkbox' name='avelica_ws_support_settings[avelica_ws_support_checkbox_field_2]'
    <?php checked($options['avelica_ws_support_checkbox_field_2'], 1);?> value='1'>
<?php

}

function avelica_ws_support_checkbox_field_3_render()
{

    $options = get_option('avelica_ws_support_settings');
    ?>
<input type='checkbox' name='avelica_ws_support_settings[avelica_ws_support_checkbox_field_3]'
    <?php checked($options['avelica_ws_support_checkbox_field_3'], 1);?> value='1'>
<?php

}

function avelica_ws_support_checkbox_field_4_render()
{

    $options = get_option('avelica_ws_support_settings');
    ?>
<input type='checkbox' name='avelica_ws_support_settings[avelica_ws_support_checkbox_field_4]'
    <?php checked($options['avelica_ws_support_checkbox_field_4'], 1);?> value='1'>
<?php

}

function avelica_ws_support_settings_section_callback()
{

    echo __('This section description', 'avelica-support');

}

function avelica_ws_support_options_page()
{

    ?>
<form action='options.php' method='post'>

    <h2>Avelica Support Plugin</h2>

    <?php
settings_fields('pluginPage');
    do_settings_sections('pluginPage');
    submit_button();
    ?>

</form>
<?php

}