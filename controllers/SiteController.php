<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Controller;

class SiteController extends Controller
{
    public function contact(): string
    {
        return $this->renderView('contact');
    }

    public function home(): string
    {
        $parameters = ['name' => 'Bukubuku'];
        return $this->renderView('home', $parameters);
    }
}
