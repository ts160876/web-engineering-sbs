<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Controller;
use Bukubuku\Models\Contact;
use Bukubuku\Core\Application;
use Bukubuku\Models\Login;

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

    public function login(): string
    {

        $login = Login::fromHttp(Application::$app->getFlashMemory(Login::class) ?? []);
        return $this->renderView('login', ['model' => $login]);
    }

    public function handleLogin(): string|null
    {
        //Get the data from the (POST) request.
        $login = Login::fromHttp(
            ['properties' => Application::$app->request->getParameters()]
        );

        //Validate the data.
        if ($login->validateData() == true) {
            if ($login->login() == true) {
                //Login was successful. 
                Application::$app->login($login->userId);
                Application::$app->setFlashSuccessMessage('You have successfully logged in.');
                //Redirect to home.
                Application::$app->response->redirect('/');
                return null;
            } else {
                //Login was not successful.
                Application::$app->setFlashErrorMessage('Your login failed.');
                //Redirect to login.
                Application::$app->response->redirect('/login');
                return null;
            }
        } else {
            //Validation has errors.
            Application::$app->setFlashErrorMessage('The form has errors. Please correct them.');
            Application::$app->setFlashMemory(Login::class, $login->toHttp());
            //Redirect back to the form.
            Application::$app->response->redirect('/login');
            return null;
        }
    }

    public function handleLogout(): string|null
    {
        //Logout, i.e. remove the user from the session.
        Application::$app->logout();
        Application::$app->setFlashSuccessMessage('You have successfully logged out.');
        //Redirect to home.
        Application::$app->response->redirect('/');
        return null;
    }
}
