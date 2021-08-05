<?php

global $is_subdomain;
$is_subdomain = false;

var_dump(is_subdomain());


function is_subdomain(){
global $is_subdomain;
return $is_subdomain;

}



?>
