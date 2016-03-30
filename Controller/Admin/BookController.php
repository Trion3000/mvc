<?php

namespace Controller\Admin;

use Library\Controller;
use Library\NotFoundException;
use Library\Request;
use Library\Router;
use Library\Session;
use Library\UploadedFile;
use Model\BookForm;
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
        $books = $model->findAll(false);

        $args = compact('books');

        return $this->render('index', $args);
    }


    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     * @throws NotFoundException
     */
    public function editAction(Request $request)
    {
        $model = new BookModel();
        $form = new BookForm($request);
        // TODO: $styleModel = new StyleModel(); => взять список категорий, передать в шаблон, сформировать <select>

        $id = $request->get('id');
        $book = $model->findById($id);
        $image = $model->imageExists($id) ? $id . '.jpg' : false;

        if ($request->isPost()) {
            $uploadedFile = new UploadedFile($request, 'image');
            if ($form->isValid()) {
                $model->save(array(
                    'id' => $id,
                    'title' => $form->title,
                    'description' => $form->description,
                    'price' => $form->price,
                    'status' => $form->status
                ));

                // TODO: flash messages
                if ($uploadedFile->uploadIsSuccessful()) {
                    // TODO: +png ?
                    if ($uploadedFile->isJpeg()) {
                        $uploadedFile->move(UPLOAD_DIR . $id . '.jpg');
                    }
                }

                Session::setFlash('Saved');
                Router::redirect('/admin/books/edit/' . $id);
            }

            Session::setFlash('Invalid data');

        } else {
            $form->setFromArray($book);
        }

        $args = compact('book', 'form', 'image');
        return $this->render('edit', $args);
    }

    public function addAction(Request $request)
    {
        // TODO
    }

}






















