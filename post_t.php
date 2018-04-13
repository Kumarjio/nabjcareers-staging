<?php
// require codebird
require_once('./twitter_php_sdk/codebird.php');
 
\Codebird\Codebird::setConsumerKey("GUnxkMFZR8bESkbbBz0QNqAKo", "NGqf9ZpOtgge9FeahGVaIuzDrkO3eWjWsZN9bwu8QrLnS8SUVb");
$cb = \Codebird\Codebird::getInstance();
$cb->setToken("247236334-7PPxmvfbBdA5vfDQUg4u1T5SBxOzltQTiKOyvxRH", "DXXiuPDnKarIzUWDEjfJVr8vb8jGJ5qMBAydQD9fWcl0y");
 
$params = array(
  'status' => 'Auto Post on Twitter with PHP http://goo.gl/OZHaQD #php #twitter'
);
$reply = $cb->statuses_update($params);
?>