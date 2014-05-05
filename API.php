<?php



namespace T4G;



require 'API/Exception.php';

require 'API/Endpoint.php';

require 'API/Section.php';

require 'API/Config.php';



class API

{

  public static $base = 'https://api.tools4games.com';

  

  protected static $sections = [];

  public static $api_key;

  public static $api_secret;

  

  public static function addSection(API\Section $section)

  {

    self::$sections[$section->id] = $section;

  }

  

  public static function execute($path, $query)

  {

    $path = self::$base . $path;

    $path.= '?' .http_build_query($query);

  

    #echo urldecode("\n$path\n");

    

    if(function_exists('curl_version'))

    { // cURL is Available

      $curl = curl_init();

      curl_setopt($curl, CURLOPT_URL, $path);

      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
      
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      

      $result = curl_exec($curl);

      curl_close($curl);

    }

    else

    { // Use file_get_contents as fallback

      $result = file_get_contents($path);

    }

    

    $result = json_decode($result);

    

    return $result;

  }

  

  public function auth($key, $secret)

  {

    self::$api_key     = $key;

    self::$api_secret  = $secret;  

  }

  

  public function __call($method, $args)

  {

    $method = strToLower(str_replace('get', '', $method));

    

    return self::$sections[$method];

  }

}











