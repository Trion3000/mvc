<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;

class DocumentController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function indexAction(Request $request)
    {
       // todo
    }


    public function addAction(Request $request)
    {
//        if ($request->isPost()) {
//            $file = new UploadedFile($request, 'document');
//            if ($file->uploadIsSuccessful()) {
//                $file->move(UPLOAD_DIR . $file->name);
//            }
//        }

        return $this->render('add');
    }

}






















