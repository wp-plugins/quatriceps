<?php
/**
 * Plugin Name: Quatriceps
 * Plugin URI: http://wp.tetragy.com/quatriceps
 * Description: Mathematics problem generator
 * Version: 0.1.1
 * Author: pmagunia
 * Author URI: https://tetragy.com
 * License: GPLv2 or Later
 */

/*  Copyright 2014  Tetragy Limited

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

# settings menu link
add_action('admin_menu', 'quatriceps_admin_add_page');
function quatriceps_admin_add_page()
{
  add_options_page('Settings', 'Quatriceps', 'manage_options', 'Quatriceps', 'quatriceps_plugin_settings_page');
}

# plugin page settings link
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'quatriceps_plugin_settings_link' );
function quatriceps_plugin_settings_link($links)
{ 
  $settings_link = '<a href="options-general.php?page=Quatriceps">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

function quatriceps_plugin_settings_page()
{ ?>
  <div class="wrap">
    <div class="wp-quatriceps-admin">
      <h2>Quatriceps Settings</h2>
      <p>Settings related to the Quatriceps plugin can be modified here and will have a global effect on all Quatriceps shortcode.</p><p>A Quatriceps account is necessary and may be obtained from <a href="https://math.tetragy.com">Tetragy</a>.</p>
      <div>
        <form action="options.php" method="post">
          <?php settings_fields('quatriceps_plugin_settings'); ?>
          <?php do_settings_sections('quatriceps'); ?>
          <br/>
          <div class-"wp-quatriceps-submit">
          <input name="Submit" type="submit" value="<?php esc_attr_e('Save'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php }

add_action('admin_init', 'quatriceps_plugin_admin_init');

function quatriceps_plugin_admin_init()
{
  register_setting( 'quatriceps_plugin_settings', 'quatriceps_id', 'quatriceps_settings_validate');
  register_setting( 'quatriceps_plugin_settings', 'quatriceps_router', 'quatriceps_settings_router_validate');
  register_setting( 'quatriceps_plugin_settings', 'quatriceps_recaptcha_publickey', 'quatriceps_recaptcha_publickey_validate');
  register_setting( 'quatriceps_plugin_settings', 'quatriceps_recaptcha_privatekey', 'quatriceps_recaptcha_privatekey_validate');
  register_setting( 'quatriceps_plugin_settings', 'quatriceps_recaptcha_theme', 'quatriceps_recaptcha_theme_validate');
  add_settings_section('quatriceps_options', 'Quatriceps', 'quatriceps_section_text', 'quatriceps');
  add_settings_section('quatriceps_recaptcha_options', 'Recaptcha', 'quatriceps_recaptcha_text', 'quatriceps');
  add_settings_field('quatriceps_id', 'Tetragy Numeric ID', 'quatriceps_setting_string', 'quatriceps', 'quatriceps_options');
  add_settings_field('quatriceps_router', 'Quatriceps Router', 'quatriceps_setting_router', 'quatriceps', 'quatriceps_options');
  add_settings_field('quatriceps_recaptcha_publickey', 'Recaptcha Public Key', 'quatriceps_setting_recaptcha_publickey', 'quatriceps', 'quatriceps_recaptcha_options');
  add_settings_field('quatriceps_recaptcha_privatekey', 'Recaptcha Private Key', 'quatriceps_setting_recaptcha_privatekey', 'quatriceps', 'quatriceps_recaptcha_options');
  add_settings_field('quatriceps_recaptcha_theme', 'Recaptcha Theme', 'quatriceps_setting_recaptcha_theme', 'quatriceps', 'quatriceps_recaptcha_options');
}

function quatriceps_section_text()
{
  echo '<p>Your Quatriceps settings page will list your numeric ID. The ID listed here will be submitted with all Quatriceps requests.</p>';
}

function quatriceps_recaptcha_text()
{
  echo '<p>Recaptcha is a Google service to help prevent spam submissions and abuse. Entering a public and private key will activite Recaptcha for all Quatriceps widgets. <strong>If you decide to use the Recaptcha service, be sure to enter the correct public and private key otherwise you may get confusing results.</strong> Also, be sure the keys you enter are for your particular domain that is registered at Google.</p>';
}

function quatriceps_setting_string()
{
  $id = get_option('quatriceps_id');
  echo "<input id='quatriceps_id' name='quatriceps_id' size='10' type='text' value='$id' />";
}

function quatriceps_setting_router()
{
  $router = get_option('quatriceps_router', 'https://route.tetragy.com');
  echo "<input id='quatriceps_router' name='quatriceps_router' size='30' type='text' value='$router' />";
}

function quatriceps_setting_recaptcha_publickey()
{
  $publickey = get_option('quatriceps_recaptcha_publickey');
  echo "<input id='quatriceps_recaptcha_publickey' name='quatriceps_recaptcha_publickey' size='40' type='text' value='$publickey' />";
}

function quatriceps_setting_recaptcha_theme()
{
	$selected = ' selected="selected" ';
  $theme = get_option('quatriceps_recaptcha_theme');
  echo "<select id='quatriceps_recaptcha_theme' name='quatriceps_recaptcha_theme'/><option" . ($theme == 'red' ? $selected : ' ') . " value='red'>Red</option><option"  . ($theme == 'white' ? $selected : ' ') . "value='white'>White</option><option"  . ($theme == 'blackglass' ? $selected : ' ') . "value='blackglass'>Blackglass</option><option" . ($theme == 'clean' ? $selected : ' ') . "value='clean'>Clean</option></select>";
}

function quatriceps_setting_recaptcha_privatekey()
{
  $privatekey = get_option('quatriceps_recaptcha_privatekey');
  echo "<input id='quatriceps_recaptcha_privatekey' name='quatriceps_recaptcha_privatekey' size='40' type='text' value='$privatekey' />";
}

function quatriceps_settings_validate($id)
{
  if(!is_numeric($id) || strlen($id) > 10)
  {
    $id = '';
  }
  return $id;
}

function quatriceps_settings_router_validate($router)
{
  if(strlen($router) > 100)
  {
    $router = 'https://route.tetragy.com';
  }
  return $router;
}

function quatriceps_recaptcha_publickey_validate($publickey)
{
  if(strlen($publickey) > 200)
  {
    $publickey = '';
  }
  return $publickey;
}

function quatriceps_recaptcha_privatekey_validate($privatekey)
{
  if(strlen($privatekey) > 200)
  {
    $privatekey = '';
  }
  return $privatekey;
}

function quatriceps_recaptcha_theme_validate($theme)
{
  $opts = array('red', 'white', 'blackglass', 'clean');
	if(!in_array($theme, $opts))
  {
    $theme = '';
  }
  return $theme;
}

# Print form with Shortcode API
function quatriceps_func( $atts ) {
  extract( shortcode_atts( array(
    'com' => 'prime',
  ), $atts ) );

	$dialog = '<div class="quatriceps-dialog"><div class="quatriceps-waiting-container"><div class="quatriceps-waiting">Computing...</div></div><div class="quatriceps-output-container"><div class="quatriceps-output"></div></div></div>';

  # if users wants to override packaged file
  if(is_file(__DIR__ . '/html/override/' . $com . '.html'))
  {
    $markup = file_get_contents(__DIR__ . '/html/override/' . $com . '.html');
  }
  else
  {
     $markup = file_get_contents(__DIR__ . '/html/' . $com . '.html');
  }
  $publickey = get_option('quatriceps_recaptcha_publickey');
  $theme = get_option('quatriceps_recaptcha_theme');
  $recap = '';
  if(strlen($publickey))
  {
    require_once 'recaptchalib.php';
    # support multiple Recaptcha
    $recap = '<div class="quatriceps-recaptcha" id="quatriceps-recaptcha-' . rand(10000,99999) . '"></div>';
  }
  $markup = '<div class="quatriceps-cp">' . $markup . '</div>';
  return '<div class="quatriceps" id="quatriceps-' . $com .'">' . $markup . $dialog . $recap . '</div>';
}

add_shortcode( 'quatriceps', 'quatriceps_func' );

add_action( 'init', 'quatriceps_script_enqueuer' );

function quatriceps_script_enqueuer() {
  wp_register_script("recaptcha_script", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", array(), '0.1.1', false);
  wp_register_script("mathjax_script", "https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML", array(), '0.1.1', false);
  wp_register_script("quatriceps_script", WP_PLUGIN_URL . '/quatriceps/quatriceps.js', array('jquery', 'mathjax_script'), '0.1.1', true);
  wp_register_style("quatriceps_css", WP_PLUGIN_URL . '/quatriceps/quatriceps.css', array(), '0.1.1', 'all');
  wp_localize_script('quatriceps_script', 'quatricepsAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'quatriceps_recaptcha_pubkey' => get_option('quatriceps_recaptcha_publickey', ''), 'recaptcha_theme' => get_option('quatriceps_recaptcha_theme', 'red'), 'quatriceps_id' => get_option('quatriceps_id', '')));        

  wp_enqueue_script('recaptcha_script');
  wp_enqueue_script('mathjax_script');
  wp_enqueue_script('quatriceps_script');
  wp_enqueue_style('quatriceps_css');
}

add_action("wp_ajax_quatriceps_compute", "prefix_ajax_quatriceps_compute");
add_action("wp_ajax_nopriv_quatriceps_compute", "prefix_ajax_quatriceps_compute");

function prefix_ajax_quatriceps_compute() {

  $privatekey = get_option('quatriceps_recaptcha_privatekey', '');
  if(strlen($privatekey))
  {
    if(!class_exists('ReCaptchaResponse'))
    {
      require_once 'recaptchalib.php';
    }
    $resp = recaptcha_check_answer($privatekey, $_SERVER["REMOTE_ADDR"], $_REQUEST["recaptcha_challenge_field"], $_REQUEST["recaptcha_response_field"]);
    if(!$resp->is_valid)
    {
      echo $_REQUEST['callback'] . '({"input":"","output":"The Recaptcha wasn\'t entered correctly. Go back and try it again.","pdf":""})';
      die();
    }
  }

  $fields['id'] = $_REQUEST['id'];
  $fields['cmd'] = $_REQUEST['cmd'];
  $fields['pdf'] = urlencode($_REQUEST['pdf']);
  $fields['arg0'] = urlencode($_REQUEST['arg0']);
  $fields['arg1'] = urlencode($_REQUEST['arg1']);
  $fields['arg2'] = urlencode($_REQUEST['arg2']);
  $fields['arg3'] = urlencode($_REQUEST['arg3']);
  $fields['carry'] = urlencode($_REQUEST['carry']); 
  $fields_string = '';
  foreach($fields as $key => $value)
  {
    $fields_string .= $key . '=' . $value . '&';
  }
  $fields_string = rtrim($fields_string, '&');
  echo $_REQUEST['callback'] . '(' . file_get_contents(get_option('quatriceps_router', 'https://route.tetragy.com') . '/index.php?' . $fields_string) . ')';
  die();
}

