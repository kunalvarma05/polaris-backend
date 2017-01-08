<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Nfreear\Cloudsight\Cloudsight_Http_Client;

class ApiController extends Controller
{

    public function getImage(Request $request) {
        return "https://www.mockupworld.co/wp-content/uploads/edd/2015/07/iPhone-6-Photo-MockUp-full-1000x683.jpg";
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

        return $result->name;
    }

}