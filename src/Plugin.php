<?php

namespace Best4u\PluginTemplate;

class Plugin
{
  protected $_context;

  protected static $_instance = null;

  public function __construct(string $main_file)
  {
    $this->_context = new Context($main_file);
  }

  public function context() : Context
  {
    return $this->_context;
  }

  public static function instance() : Plugin
  {
    return static::$_instance;
  }

  public function register()
  {
    (new Assets($this->_context))->register();
  }

  public static function load(string $main_file) : bool
  {
    if (static::$_instance !== null) {
      return false;
    }

    static::$_instance = new static($main_file);
    static::$_instance->register();

    return true;
  }
}
