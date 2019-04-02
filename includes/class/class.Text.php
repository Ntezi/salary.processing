<?php

      class Text {

            public  $text;

            function __construct () {

            }

            function __destruct () {
            }

            public function cleanText ($text) {
                  $text = trim ($text);
                  $text = htmlentities ($text);
                  $text = stripslashes($text);
                  $text = strip_tags($text);
                  $text = str_replace("'","&#39;",$text);
                  return $text;
            }

            public function toAscii($str) {
                  $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
                  $clean = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $clean);
                  $clean = strtolower(trim($clean, '-'));
                  $clean = preg_replace("/[\/_| -]+/", '-', $clean);
                  return $clean;
            }

            public function hideUlr($url){
                  list($file, $parameters) = explode('?', $url);
                  parse_str($parameters, $output);
                  unset($output['id_category']); // remove the make parameter
                  $result = $file . '?' . http_build_query($output); // Rebuild the url
                  return $result;
            }

            public function setText($text){
                  $this->text = $text;
            }

            public function getText(){
                  return $this->text;
            }
      }

?>