<?php

add_action('admin_menu', 'wp_moj_problem_with_page_create_menu');

function wp_moj_problem_with_page_create_menu() {
    //create new top-level menu
    add_options_page('WP MOJ Problem with page','WP MOJ Problem with page', 'manage_options', __FILE__, 'wp_moj_problem_with_page_settings_page');
    //place this plugin settings page within the ‘Manage Plugins’ listing page
    add_filter("plugin_action_links", "wp_moj_problem_with_page_settings_link", 10, 2 );
    //call register settings function
    add_action('admin_init', 'wp_moj_problem_with_page_register_settings');
}

//add settings link to plugins list
function wp_moj_problem_with_page_settings_link($links, $file) {
    static $this_plugin;
    if (!$this_plugin) $this_plugin = plugin_basename(__FILE__);
    if ($file == $this_plugin){
        $settings_link = '<a href="options-general.php?page=WPMOJProblemWithPage/wp-moj-problem-with-this-page.php">'.__("Settings", "wp_moj_problem_with_page").'</a>';
    array_unshift($links, $settings_link);
    }
    return $links;
}

function wp_moj_problem_with_page_register_settings() {
    //register our settings - the name and email address of the person/group to whom this message will be sent
    register_setting('wp_moj_problem_with_page',  ' wp_moj_problem_with_page_name');
    register_setting('wp_moj_problem_with_page',  ' wp_moj_problem_with_page_email');
}

//html for Problem with this page settings form
function pwtpm_settings_page() { ?>
		<h2>Problem with this page - Settings</h2>
		<form method="post" action="options.php">
			<fieldset>
				<legend>Enter the name and email address of the person/group to whom this message will be sent.</legend><label for="pwtpm_name">Name of individual or group: (This information must be provided)</label><br>
				<input type="text" cols="200" id="pwtpm_name" name="pwtpm_name" /><br>
				<label for="pwtpm_email">Email address:</label><br>
				<input type="email" cols="200" id="pwtpm_email" name="pwtpm_name" /><br>
			</fieldset>
			<button type="submit">Submit</button>
			</form>

<?php }

/* Begin Widget Class */
class WP_MOJ_Problem_with_this_page_Widget extends WP_Widget {
/* Widget setup */
function WP_MOJ_Problem_with_this_page_Widget() {
$widget_ops = array('classname' => 'pwtpm_widget', 'description' => ➥
__( 'WP MOJ Problem with this page', 'pwtpm') );
// The actual widget code goes here
parent::WP_Widget( false, $name = 'WP MOJ Problem with this Page', $widget_ops );
}
/* Display the widget */
function widget( $args, $instance ) {
//get widget arguments
extract($args);
//get widget title from instance variable
$title = apply_filters('widget_title', $instance['title']);
//insert before widget markup
echo $before_widget;
//if theres a title, echo it.
if( $title )
echo $before_title . $title . $after_title;
//start list
$stakeholder_list .= '<ul>';
// define list
if (get_option('pwtpm_name' )){
    $social_list .= '<li class="pwtpm_name"><a href="'. get_option('pwtpm-name').'">' . __('Stakeholder Name', 'pwtpm') . '</a></li>';
}
if (get_option('pwtpm_name' )){
    $social_list .= '<li class="pwtpm_email"><a href="'. get_option('pwtpm-email').'">' . __('Stakeholder Email', 'pwtpm') . '</a></li>';
    }
// end list
$share_content .= '</ul>';
//display assembled list
echo $social_list;
//insert before widget markup
echo $after_widget;
}
/* Update the widget settings, just the title in this case */
function update( $new_instance, $old_instance ) {
$instance = $old_instance;
$instance['title'] = strip_tags($new_instance['title']);
return $instance;
}
//form to display in widget settings. Allows user to set
//title of widget.
function form( $instance ) {
    $title = esc_attr($instance['title']);
?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>
<?php
}
}
/* Load the widget */
add_action( 'widgets_init', 'pwtpm_register_widget' );
?>

