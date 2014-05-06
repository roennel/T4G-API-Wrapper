<?php

namespace T4G;

//* SECTION: Blacklist */
$blacklist = new API\Section;
$blacklist->id = 'blacklist';

  /* ENDPOINT: Server */
  $ep = new API\Endpoint;
  $ep->id = 'server';
  $ep->path = '/blacklist/server';

  $ep->requiredParams = 
  [
    'api_key',
    'api_secret',
    ['bookmarklink', 'serverId']
  ];

  $ep->optionalParams = [];

  $blacklist->addEndpoint($ep);
  /* /ENDPOINT: Server */
  
  /* ENDPOINT: Servers */
  $ep = new API\Endpoint;
  $ep->id = 'servers';
  $ep->path = '/blacklist/servers';
  $ep->requiredParams = 
  [
    'api_key',
    'api_secret'
  ];
  
  $ep->optionalParams = 
  [
    'disabled'  => [false, true],
    'online'    => [false, true],
    'noLogin'   => [false, true]
  ];
  
  $blacklist->addEndpoint($ep);
  /* /ENDPOINT: Server */
  
  /* ENDPOINT: Player */
  $ep = new API\Endpoint;
  $ep->id = 'player';
  $ep->path = '/blacklist/player';
  $ep->requiredParams = 
  [
    'api_key',
    'api_secret'
  ];
  
  $ep->optionalParams = 
  [
    
  ];
  
  $blacklist->addEndpoint($ep);
  /* /ENDPOINT: Player */

API::addSection($blacklist);
/*  /SECTION: Blacklist */
