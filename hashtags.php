<?php 
$text = preg_replace(
    '/\s+#(\w+)/',' <a href="http://search.twitter.com/search?q=%23$1">#$1</a>','hash');
	
echo $text;
?>