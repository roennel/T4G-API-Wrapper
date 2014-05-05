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

API::addSection($blacklist);
/*  /SECTION: Blacklist */
