<?php

namespace Bukubuku\Controllers;

use Bukubuku\Core\Application;
use Bukubuku\Core\Controller;
use Bukubuku\Models\User;
use Bukubuku\Core\Exception\InternalErrorException;

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

    public function list(): string
    {
        $users = User::getAll();
        return $this->renderView('users/list', ['users' => $users]);
    }

    public function edit(): string
    {
        if (Application::$app->getFlashMemory(User::class) != null) {
            $user = User::fromHttp(Application::$app->getFlashMemory(User::class));
        } else {
            $userId = Application::$app->request->getParameter('userId');
            if ($userId != null) {
                $user = User::fromDatabase($userId);
            } else {
                throw new InternalErrorException();
            }
        }
        return $this->renderView('/users/edit', ['model' => $user]);
    }

    public function handleEdit(): string|null
    {
        //Get the data from the (POST) request.
        $user = User::fromHttp(
            ['properties' => Application::$app->request->getParameters()]
        );

        //Validate the data.
        if ($user->validateData() == true) {
            if ($user->update() == true) {
                //Creation was successful. 
                Application::$app->setFlashSuccessMessage('You have successfully updated the user.');
                //Redirect to home.
                Application::$app->response->redirect('/');
                return null;
            } else {
                //Registration as not successful.
                Application::$app->setFlashErrorMessage('The user update failed.');
                //Redirect back to the form.
                Application::$app->response->redirect('/users/edit');
                return null;
            }
        } else {
            //Validation has errors.
            Application::$app->setFlashErrorMessage('The form has errors. Please correct them.');
            Application::$app->setFlashMemory(User::class, $user->toHttp());
            //Redirect back to the form.
            Application::$app->response->redirect("/users/edit?userId=$user->userId");
            return null;
        }
    }
}
