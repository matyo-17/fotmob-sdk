<?php

require __DIR__.'/../vendor/autoload.php';

use Matyo17\FotmobSdk\Leagues;

echo "<pre>";

$league = new Leagues(47);

$details = $league->details();
print_r($details);

$seasons = $league->seasons();
print_r($seasons);

$league->change_season($seasons[1]);
$details = $league->details();
print_r($details);

$matches = $league->matches();
print_r($matches);

echo "</pre>";
?>