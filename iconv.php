<?php
$text = utf8_encode("This is the Euro symbol '�'.");
echo 'Plain    : ', iconv("UTF-8", "ISO-8859-1", $text);
echo $text;
?>