<?php

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

    private function load_data() {
        $payload = [
            'leagueId' => $this->id,
            'season' => $this->season,
        ];
        $url = Fotmob::$api_url."leagues?".http_build_query($payload);
        $this->data = $this->call_api('get', $url);
    }
}
?>