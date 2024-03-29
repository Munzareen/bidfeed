<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = 'https://www.bitfeed.qlogictechnologies.com/mobile/index.php/api/';
        $this->apiImageUrl = null;
        $this->setCurrency = '$';

        $data = array(
            'apiBaseUrl' => $this->apiBaseUrl,
            'apiImageUrl' => $this->apiImageUrl,
            'setCurrency' => $this->setCurrency
        );

        View::share('data', $data);
    }
}
