<?php

namespace T4G\API;

class Endpoint
{
  public $id;
  public $path;
  public $args = [];
  public $requiredParams = [];
  public $optionalParams = [];

  protected $options = [];

  private $skipParams = 
  [
    'api_key',
    'api_secret'
  ];

  public function __call($method, $args)
  {
    $this->options[$method] = [];
    $this->options[$method]['enabled'] = 1;

    if(count($args) > 0)
    {
      foreach($args[0] as $key => $value)
      { 
        $this->options[$method][$key] = $value;
      }
    }

    return $this;
  }

  public function execute()
  {
    if(!is_array($this->args)) $this->args = [];

    $path   = $this->path;
    $query  = [];
    
    try
    {
      foreach($this->requiredParams as $param)
      {
        $notFound = 0;
        $multi  = true;
        $search = $param;

        if(!is_array($param))
        {
          $multi  = false;
          $search = [$param];
        }

        foreach($search as $item)
        {
          if($multi && !array_key_exists($item, $this->args) && !in_array($item, $this->skipParams))
          {
            $notFound++;
            continue;  
          }

          if(!$multi && !array_key_exists($item, $this->args) && !in_array($item, $this->skipParams))
          {
            throw new Exception("Required Parameter '{$item}' is missing");
          }

          if(in_array($item, $this->skipParams))
          {
            $query[$item] = \T4G\API::$$param; 
          }
          else
          {
            $query[$item] = $this->args[$item];
          }
        }

        if($multi && $notFound >= count($param))
        {
          throw new Exception("One of the following Parameters is required: " . implode(' / ', $param));
        }
      }
    }

    catch(Exception $e)
    {
      echo $e->getMessage();
    }
    
    foreach($this->args as $key => $value)
    {
      $query[$key] = $value;
    }

    foreach($this->options as $key => $value)
    {
      $query[$key] = $value;  
    }

    return \T4G\API::execute($path, $query);
  }
}
