<?php

namespace Best4u\PluginTemplate\Helpers;

class Str
{
  protected $_string = '';

  public function __construct(string $string)
  {
    $this->_string = $string;

    return $this;
  }

  public static function from(string $string)
  {
    return new static($string);
  }

  public function __toString()
  {
    return $this->_string;
  }

  public function contains($needle)
  {
    return strpos($this->_string, $needle) !== false;
  }

  public function replace($needle, $replace)
  {
    $this->_string = str_replace($needle, $replace, $this->_string);

    return $this;
  }

  public function starts_with($needle)
  {
    return (substr($this->_string, 0, strlen($needle)) === $needle);
  }

  public function ends_with($needle)
  {
    return (substr($this->_string, -1 * strlen($needle)) === $needle);
  }
}
