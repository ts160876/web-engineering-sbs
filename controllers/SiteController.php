<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Controller;
use Bukubuku\Models\Contact;
use Bukubuku\Core\Application;

class SiteController extends Controller
{
    public function contact(): string
    {
        $contact = Contact::fromHttp(Application::$app->getFlashMemory(Contact::class) ?? []);
        return $this->renderView('contact', ['model' => $contact]);
    }

    public function handleContact(): string|null
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
                Application::$app->setFlashSuccessMessage('We will contact you soon');
                Application::$app->response->redirect('/');
                return null;
            } else {
                //Contact request was not successful.
                //TODO
                Application::$app->setFlashErrorMessage('We will NOT contact you');
                Application::$app->response->redirect('/');
                return null;
            }
        } else {
            //Validation has errors.
            Application::$app->setFlashErrorMessage('The form has errors. Please correct them.');
            Application::$app->setFlashMemory(Contact::class, $contact->toHttp());
            Application::$app->response->redirect('/contact');
            return null;
        }
    }

    public function home(): string
    {
        $parameters = ['name' => 'Bukubuku'];
        return $this->renderView('home', $parameters);
    }
}
