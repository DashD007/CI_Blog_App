<?php

namespace App\Controllers\Comment;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Comment\Comment;
class CommentController extends BaseController
{
    public function saveComment($id) {

        $comment = new Comment();


        $data = [
            "content" => $this->request->getPost('content'),
            "commented_by" => auth()->user()->id,
            "blog_id" => $id,
        ];

        $comment->save($data);

        if($comment){
            return redirect()->to(base_url("/blog/{$id}"))->with("create","comment created successfully");
        }
    }
}
