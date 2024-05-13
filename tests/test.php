<?php

require __DIR__.'/../vendor/autoload.php';

use Matyo17\FotmobSdk\Fotmob;

$fm = new Fotmob();
$fm->get_all_leagues();
?>