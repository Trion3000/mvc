<?php

namespace Controller;

use Library\Controller;
use Library\MetaHelper;
use Library\NotFoundException;
use Library\Request;
use Model\BookModel;

class BookController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
        $model = new BookModel();
        $books = $model->findAll();

        $args = compact('books');

        return $this->render('index', $args);
    }


    public function showAction(Request $request)
    {
        $id = $request->get('id');
        $book = (new BookModel())->findById($id);

        MetaHelper::addTitle($book['title']);
        MetaHelper::addTitle($book['price']);
        $args = compact('book');
        return $this->render('show', $args);
    }

    /**
     * test
     *
     * @param Request $request
     * @return string
     * @throws NotFoundException
     */
    public function apiBooksListAction(Request $request)
    {
        $model = new BookModel();
        $books = $model->findAll();

        return json_encode($books);
    }

    public function apiBookShowAction(Request $request)
    {
        // TODO
    }


}






















