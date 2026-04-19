<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Controller;
use Bukubuku\Models\Contact;
use Bukubuku\Core\Application;

class SiteController extends Controller
{
    public function contact(): string
    {
        return $this->renderView('contact');
    }

    public function handleContact(): string
    {
        //Get the data from the (POST) request.
        $contact = Contact::fromHttp(
            ['properties' => Application::$app->request->getParameters()]
        );

        //Validate the data.
        if ($contact->validateData() == true) {
            if ($contact->process() == true) {
                //Context requests was successful.
                //TODO
                return 'We will contact you soon';
            } else {
                //Contact request was not successful.
                //TODO
                return 'We will NOT contact you';
            }
        } else {
            //Validation has errors.
            //TODO
            return json_encode($contact->errors);
        }
    }

    public function home(): string
    {
        $parameters = ['name' => 'Bukubuku'];
        return $this->renderView('home', $parameters);
    }
}
