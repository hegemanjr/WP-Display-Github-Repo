<?php
/**
 * @link              https://hegeman.me
 * @since             1.0.0
 * @package           wp_display_github_repo
 *
 * @wordpress-plugin
 * Plugin Name:       WP Display Github Repo
 * Plugin URI:        https://608.software
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Jeff Hegeman
 * Author URI:        https://hegeman.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp_display_github_repo
 */

class WP_Display_Github_Repo {
//    public $required_plugin = 'hello.php';// See documentation for is_plugin_active()

    function __construct() {
        add_action('init', array($this, 'action_init'));
        require (plugin_dir_path(__FILE__) . 'parsedown/Parsedown.php');
    }

    public function action_init() {
        add_action('admin_notices', array($this, 'action_admin_notices'));
        add_shortcode( "display_github", array($this, 'add_shortcode'));
        register_activation_hook( __FILE__, array($this, 'activate_plugin_name'));
        register_deactivation_hook( __FILE__, array($this, 'deactivate_plugin_name'));
    }

    function action_admin_notices() {
        // check if $required_plugin is installed and active
        if (isset($this->required_plugin) && $this->required_plugin != '' && !$this->required_plugin_is_active()) {
            ?>
            <div class="notice notice-error">
                <p><strong>WP Display Github Repo</strong>: 'Hello Dolly' plugin is required. Please ensure it is installed and active.</p>
            </div>
            <?php
        }
    }

    private function required_plugin_is_active(){
            return is_plugin_active($this->required_plugin);
    }

    function add_shortcode( $atts ) {
        $a = shortcode_atts( array(
            'foo' => 'something',
            'bar' => 'something else',
        ), $atts );

        $repo_readme = file_get_contents('https://raw.githubusercontent.com/hegemanjr/wp-welcome-user/master/README.md');

        $Parsedown = new Parsedown();

//        return $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>

        return $Parsedown->text($repo_readme);

//        return "foo = {$a['foo']}";
    }

    function activate_plugin() {
        // Do stuff
    }

    function deactivate_plugin() {
        // Do stuff
    }
}
new WP_Display_Github_Repo();





