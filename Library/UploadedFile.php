<?php

namespace Library;

class UploadedFile
{
    public $name;
    public $tmpName;
    public $error;
    public $size;
    public $type;

    public function __construct(Request $request, $name)
    {
        $file = $request->files($name);
        if (is_null($file)) {
            return;
        }

        $this->name = $file['name'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->type = $file['type'];
        $this->size = $file['size'];
    }

    public function uploadIsSuccessful()
    {
        return !$this->error;
    }

    public function isNotUploaded()
    {
        return $this->error == 4;
    }

    public function move($to)
    {
        $res = move_uploaded_file($this->tmpName, $to);

        if (!$res) {
            throw new \Exception('File copy failed', 500);
        }
    }

    public function getMbSize()
    {
        return $this->size / 1000000;
    }

    public function isImage()
    {
        return strpos($this->type, 'image') === 0;
    }

    public function isJpeg()
    {
        return $this->type == 'image/jpeg';
    }

}