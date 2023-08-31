<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $serverError = 500;
    protected $badRequest = 400;
    protected $unauthorized = 401;
    protected $forbidden = 403;
    protected $notFound = 404;
    protected $success = 200;
    protected $noContent = 204;
    protected $partialContent = 206;

    public function ErrorMessage($e){

      // return $e->getMessage();
      return 'Something Went Wrong.';
    }

    public function uploadDocuments($files, $path)
    {
        $imageName = substr(time(),-5). $files->getClientOriginalName();
        $files->move($path, $imageName);
        return $imageName;
    }
}
