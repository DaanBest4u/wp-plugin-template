<?php
/**
 * Plugin Name: Plugin Template
 * Version:     1.0.0
 * Author:      Best4u
 * Text Domain: 
 */

function b4u_plugin_load()
{
  if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
  } elseif (!class_exists('Best4u\\PluginTemplate\\Plugin')) {
    $plugin_dir = plugin_dir_path(__FILE__);
    require_once $plugin_dir . 'src/Helpers/Helpers.php';
    require_once $plugin_dir . 'src/Helpers/Str.php';
    require_once $plugin_dir . 'src/Plugin.php';
    require_once $plugin_dir . 'src/Context.php';
    require_once $plugin_dir . 'src/Assets.php';
    require_once $plugin_dir . 'src/ProductHandler.php';
  }

  Best4u\PluginTemplate\Plugin::load(__FILE__);
}

b4u_plugin_load();
