<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Storage;
use Nfreear\Cloudsight\Cloudsight_Http_Client;

class ApiController extends Controller
{

    public $client;

    public function __construct() {
        $this->client = new GuzzleClient([
            // Base URI is used with relative requests
            'base_uri' => 'http://veggiefactory.in:3001'
        ]);
    }

    public function getImage(Request $request) {
        $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input("image")));
        $name = "uploads/" . str_random(10) . ".png";
        \Storage::disk("public")->put($name, $data);
        return $request->input("url") . "/" . $name;
    }

    public function getSuggestions(Request $request)
    {
        $client = new CloudSight_Http_Client(env("CS_API_KEY"));
        $req = $client->postImageRequests($this->getImage($request));

        while (1) {

            // Wait
            sleep(0.5);

            $result = $client->getImageResponses($req->token);

            // Check if analysis is complete.
            if ($client->isComplete()) {
                break;
            }
        }

        $info = $this->getInfo($result->name);
        $recomm = $this->getRecomm($info);

        return ["info" => $info, "recommendations" => $recomm];
    }

    public function getInfo($q) {
        $r = $this->client->request('POST', '/find', [
            'json' => ['query' => $q]
        ]);

        return $r->getBody();
    }

    public function getRecomm($q) {
        $r = $this->client->request('POST', '/recommendation', [
            'json' => json_decode($q)
        ]);

        return $r->getBody();
    }

}