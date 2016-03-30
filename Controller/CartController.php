<?php

namespace Controller;


use Library\Controller;
use Library\Request;
use Library\Router;
use Model\BookModel;
use Model\Cart;

class CartController extends Controller
{
    public function addAction(Request $request)
    {
        $id = $request->get('id');
        $cart = new Cart();
        $cart->addProduct($id);

        // TODO: set flash

        Router::redirect("/book-{$id}.html");
    }

    public function indexAction(Request $request)
    {
        $cart = new Cart();

        $booksIds = $cart->getProducts();

        $model = new BookModel();
        $books = $model->findByIdArray($booksIds);

        return $this->render('index', compact('books'));
    }

}