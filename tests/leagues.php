<?php

require __DIR__.'/../vendor/autoload.php';

use Matyo17\FotmobSdk\Leagues;

echo "<pre>";

// basic league (example used: EPL)
$league = new Leagues(47);

$details = $league->details();
echo "League: ";
print_r($details);
echo "<br>";

$seasons = $league->seasons();
echo "Seasons: ";
print_r($seasons);
echo "<br>";

$league->change_season($seasons[1]);
$details = $league->details();
echo "League: ";
print_r($details);
echo "<br>";

$teams = $league->teams();
echo "Teams: ";
print_r($teams);
echo "<br>";

$matches = $league->matches();
echo "Matches: ";
print_r($matches);
echo "<br>";

echo "<hr>";

// composite league (example used: UCL)
$league = new Leagues(42);

$details = $league->details();
echo "League: ";
print_r($details);
echo "<br>";

$seasons = $league->seasons();
echo "Seasons: ";
print_r($seasons);
echo "<br>";

$teams = $league->teams();
echo "Teams: ";
print_r($teams);
echo "<br>";

$matches = $league->matches();
print_r($matches);
echo "<br>";

echo "</pre>";
?>