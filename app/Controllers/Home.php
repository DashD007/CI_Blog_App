<?php

namespace App\Controllers;
use App\Models\Post\Post;

use Config\Database;

class Home extends BaseController
{   
    protected $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function index()
    {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $posts = new Post();
        $data['posts'] = $posts->findAll();

        return view('home.php',$data);
    }

}
