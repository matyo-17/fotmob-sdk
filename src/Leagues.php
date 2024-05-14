<?php

namespace Matyo17\FotmobSdk;

use Exception;
use Matyo17\FotmobSdk\Fotmob;

class Leagues extends Fotmob {
    private int $id;
    private string $season;

    public array $data;

    public function __construct(int $id, ?string $season="") {
        $this->id = $id;
        $this->season = $season;

        $this->load_data();
    }

    public function seasons() {
        return $this->data['allAvailableSeasons'];
    }

    public function change_season(?string $season="") {
        $available_seasons = $this->seasons();
        if ($season && !in_array($season, $available_seasons)) {
            throw new Exception("Season not available");
        }

        $this->season = $season;
        $this->load_data();
    }

    public function details() {
        $details = $this->data['details'];
        
        unset(
            $details["breadcrumbJSONLD"],
            $details["faqJSONLD"],
        ); 

        return $details;
    }

    public function matches() {
        $matches = $this->data['matches']['allMatches'];
        foreach ($matches as $i => $v) {
            unset($matches[$i]['pageUrl']);
        }
        return $matches;
    }

    public function teams() {
        $table = $this->data['table'][0]['data'];

        $teams = [];
        if ($table['composite']) {
            $groups = $table['tables'];
            foreach ($groups as $grp) {
                $teams = array_merge($teams, $grp['table']['all']);
            }
        } else {
            $teams = $table['table']['all'];
        }

        foreach ($teams as $i => $v) {
            unset(
                $teams[$i]['pageUrl'],
                $teams[$i]['qualColor'],
            );
        }

        return $teams;
    }

    private function load_data() {
        $payload = [
            'id' => $this->id,
            'season' => $this->season,
        ];
        $url = Fotmob::$api_url."leagues?".http_build_query($payload);
        $this->data = $this->call_api('get', $url);
    }
}
?>