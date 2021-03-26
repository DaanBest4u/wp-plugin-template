<?php

namespace Best4u\PluginTemplate;

class Context
{
  protected $_main_file;

  public function __construct(string $main_file)
  {
    $this->_main_file = $main_file;
  }

  public function file() : string
  {
    return $this->_main_file;
  }

  public function basename() : string
  {
    return plugin_basename($this->_main_file);
  }

  public function path(string $relative_path = '/') : string
  {
    return plugin_dir_path($this->_main_file) . ltrim($relative_path, '/');
  }

  public function url(string $relative_path = '/') : string
  {
    return plugin_dir_url($this->_main_file) . ltrim($relative_path, '/');
  }

  public function is_ajax() : bool
  {
    if (wp_doing_ajax()) {
      return true;
    }

    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(wp_unslash($_SERVER['HTTP_X_REQUESTED_WITH'])) === 'xmlhttprequest';
  }

  public function is_amp() : bool
  {
    return function_exists('is_amp_endpoint') && is_amp_endpoint();
  }

  public function is_cron() : bool
  {
    return wp_doing_cron();
  }
}
