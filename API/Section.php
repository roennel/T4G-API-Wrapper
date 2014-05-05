<?php

namespace T4G\API;

class Section
{
  public $id;
  
  protected $endpoints = [];
  
  public function addEndpoint(Endpoint $endpoint)
  {
    $this->endpoints[$endpoint->id] = $endpoint;
  }
  
  public function getEndpoints()
  {
    return $this->endpoints;
  }
  
  public function __call($method, $args)
  {
    $method = strToLower(str_replace('get', '', $method));
    
    $call = $this->endpoints[$method];
    $call->args = count($args) > 0 ? $args[0] : [];
    
    return $call;
  }
}