<?php
$some="Anuj|12123456";
 strpos($some, '|', 0);
 strlen($some);
echo substr($some,strpos($some, '|', 0)+1,strlen($some));
?>