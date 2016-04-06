<?php
/**
 * Created by PhpStorm.
 * User: henry
 * Date: 06.04.16
 * Time: 23:55
 */

namespace Controller\Admin;


use Library\Controller;
use Library\Request;
use Library\Router;
use Library\Session;

class IndexController extends Controller
{
    public function indexAction(Request $request)
    {
        if (!Session::has('user')) {
            Router::redirect('/login');
        }

        return $this->render('index');
    }
}