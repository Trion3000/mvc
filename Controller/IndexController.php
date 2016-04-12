<?php

namespace Controller;

use Library\Controller;
use Library\Request;
use Library\Router;
use Library\Session;
use Model\ContactForm;
use Model\FeedbackModel;
use Model\PageModel;

class IndexController extends Controller
{

    public function ajaxAction(Request $request)
    {
        $fruits = array(
            'oranges' => 324,
            'apples' => 67
        );

        //echo $request->get('a');
        print_r($_POST);
        //echo json_encode($fruits);
        //file_put_contents('blah.txt', 234);
    }


    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
        $model = new PageModel();
        $page = $model->findByAlias('homepage');

        $args = array(
            'page' => $page
        );
        
        return $this->render('index', $args);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function contactAction(Request $request)
    {
        $form = new ContactForm($request);
        $datetime = new \DateTime();

        if ($request->isPost()) {
            if ($form->isValid()) {
                (new FeedbackModel())->save(array(
                    'id' => null,
                    'username' => $form->username,
                    'email' => $form->email,
                    'message' => $form->message,
                    'created' => $datetime->format('Y-m-d H:i:s'),
                    'ip' => $request->getIpAddress()
                ));

                Session::setFlash('Message sent');
                Router::redirect('/contact-us');
            }

            Session::setFlash('Fill the fields');
        }

        $args = compact('form');

        return $this->render('contact', $args);
    }

}






















