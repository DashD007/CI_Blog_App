<?php

namespace App\Controllers\Blog;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Category\Category;
use App\Models\Post\Post;
use Config\Database;

class BlogController extends BaseController
{
    protected $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function get($id) {

        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        // to update the view of blog to make it popular
        $updatedView = $this->db->query("UPDATE posts SET posts.view = posts.view +1 where id = $id;");

        //this is blog content
        $postData = $this->db->query("SELECT posts.*,users.username,categories.name as category FROM `posts` LEFT JOIN `users` ON posts.publishedBy = users.id LEFT JOIN `categories` ON posts.category_id = categories.id where posts.id = $id ;")->getResult()[0];
        //other popular blogs
        $popularBlogs = $this->db->query("SELECT posts.*,users.username,categories.name as category FROM `posts` LEFT JOIN `users` ON posts.publishedBy = users.id LEFT JOIN `categories` ON posts.category_id = categories.id ORDER BY posts.view DESC LIMIT 3;")->getResult();

        //category of blog
        $categories = $this->db->query("SELECT categories.name,count(posts.category_id) as count from categories INNER JOIN posts on categories.id = posts.category_id GROUP By posts.category_id;")->getResult();

        //comments 
        $comments = $this->db->query("SELECT comments.*,users.username FROM comments LEFT JOIN users on commented_by = users.id where blog_id = $id ORDER BY comments.created_at DESC;")->getResult();

        return view('blogs/get.php',compact('postData','popularBlogs','categories','comments'));
    }

    public function blogCreateView(){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $category = new Category();
        
        $categories = $category->select('id,name')->get()->getResult();
        
        return view("blogs/create",compact('categories'));
    }


    public function create() {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $post = new Post();

        $img = $this->request->getFile('image');
        $img->move('public/assets/images');

        $data = [
            "title" => $this->request->getPost('title'),
            "content" => $this->request->getPost('content'),
            "publishedBy" => auth()->user()->id,
            "category_id" => $this->request->getPost('category_id'),
            "coverImageURL" => $img->getClientName(),
        ];

        $post->save($data);

        if($post){
            return redirect()->to(base_url("/blog/create/view"))->with("create","Blog created successfully");
        }
    }

    public function blogUpdateView($id) {

        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $postData = $this->db->query("SELECT * FROM `posts`  where posts.id = $id ;")->getResult()[0];
        
        
        if($postData->publishedBy !== (string)auth()->user()->id){
            return redirect()->to(base_url("/"));    
        }

        $category = new Category();
        
        $categories = $category->select('id,name')->get()->getResult();
        
        return view("blogs/update",compact('categories','postData'));

        
    }

    public function update($id) {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $post = new Post();

        $data = [
            "title" => $this->request->getPost('title'),
            "content" => $this->request->getPost('content'),
            "category_id" => $this->request->getPost('category_id'),
        ];

        
        $post->update($id,$data);

        if($post){
            return redirect()->to(base_url("/blog/update/view/" . $id))->with("update","Blog updated successfully");
        }
    }
    public function delete($id) {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $post = new Post();

        $postData = $this->db->query("SELECT publishedBy FROM `posts`  where posts.id = $id ;")->getResult()[0];

        if($postData->publishedBy !== (string)auth()->user()->id){
            return redirect()->to(base_url("/"));    
        }
        
        $post->delete($id);

        if($post){
            return redirect()->to(base_url("/"))->with("delete","Blog deleted successfully");
        }
    }
}
