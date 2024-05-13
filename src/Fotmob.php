<?php

namespace Matyo17\FotmobSdk;

use Exception;
use Httpful\Request;
use Httpful\Response;

Class Fotmob {
    private static string $api_url = "https://www.fotmob.com/api/";

    public function __construct() {
        
    }

    public function get_all_leagues() {
        return $this->get(self::$api_url."allLeagues");
    }

    public function get_league_teams(int $id) {
        $url = self::$api_url."tltable?".http_build_query(['leagueId' => $id]);
        $response = $this->get($url);
        return $response[0]['data']['table']['all'];
    }

    protected function get(string $url, $payload = null) {
        return $this->call_api('get', $url, $payload);
    }

    private function call_api(string $method, string $url, $payload = null) {
        $method = strtolower($method);

        switch ($method) {
            case 'post':
                $request = Request::post($url, $payload);
                break;
            case 'patch':
                $request = Request::patch($url, $payload);
                break;
            case 'delete':
                $request = Request::delete($url);
                break;
            case 'put':
                $request = Request::put($url);
                break;
            default:
                $request = Request::get($url);
                break;
        }

        return $this->map_response($request->send());
    }

    private function map_response(Response $response) {
        $body = $response->body;

        $resp_type = gettype($body);
        if ($resp_type !== 'object' && $resp_type !== 'array') {
            throw new Exception("return body cannot be converted to array");
        }

        return json_decode(json_encode($body), true);
    }
}
?>