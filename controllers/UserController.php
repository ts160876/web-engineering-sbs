<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Application;
use Bukubuku\Core\Controller;
use Bukubuku\Models\User;

class UserController extends Controller
{

    //Create a user.
    public function create(): string
    {
        $user = User::fromHttp(Application::$app->getFlashMemory(User::class) ?? []);
        return $this->renderView('/users/create', ['model' => $user]);
    }

    public function handleCreate(): string|null
    {
        //Get the data from the (POST) request.
        $user = User::fromHttp(
            ['properties' => Application::$app->request->getParameters()]
        );

        //Validate the data.
        if ($user->validateData() == true) {
            if ($user->insert() == true) {
                //Creation was successful. 
                Application::$app->setFlashSuccessMessage('You have successfully create the user.');
                //Redirect to home.
                Application::$app->response->redirect('/');
                return null;
            } else {
                //Registration as not successful.
                Application::$app->setFlashErrorMessage('The user creation failed.');
                //Redirect back to the form.
                Application::$app->response->redirect('/users/create');
                return null;
            }
        } else {
            //Validation has errors.
            Application::$app->setFlashErrorMessage('The form has errors. Please correct them.');
            Application::$app->setFlashMemory(User::class, $user->toHttp());
            //Redirect back to the form.
            Application::$app->response->redirect('/users/create');
            return null;
        }
    }
}
