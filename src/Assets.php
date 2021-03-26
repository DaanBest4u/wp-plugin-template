<?php

namespace Best4u\PluginTemplate;

use Best4u\PluginTemplate\Helpers\Str;

class Assets
{
  protected $_context;
  protected $_manifest = [];

  public function __construct(Context $context)
  {
    $this->_context = $context;
  }

  public function register()
  {
    if (!$this->_load_manifest()) {
      return;
    }

    add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);

    add_action('wp_enqueue_scripts', [$this, 'enqueue_client_assets']);
  }

  protected function _load_manifest()
  {
    if (!file_exists($this->_context->path('assets/dist/manifest.json'))) {
      return false;
    }

    $assets = json_decode(file_get_contents($this->_context->path('assets/dist/manifest.json')), true);

    $assets = array_map(function ($asset) {
      return (string) Str::from($asset)->replace('./', $this->_context->url('assets/dist/'));
    }, $assets);

    $this->_manifest = $assets;

    return true;
  }

  protected function _enqueue_assets_with(string $string)
  {
    $manifest = $this->_manifest;

    foreach ($manifest as $file => $path) {
      if (!Str::from($file)->contains($string)) {
        continue;
      }

      if (Str::from($file)->ends_with('.css')) {
        wp_enqueue_style($file, $path);
        continue;
      }

      if (Str::from($file)->ends_with('.js')) {
        wp_enqueue_script($file, $path, [], '', true);
      }
    }
  }

  public function enqueue_admin_assets()
  {
    $this->_enqueue_assets_with('admin');
  }

  public function enqueue_client_assets()
  {
    $this->_enqueue_assets_with('client');
  }
}
