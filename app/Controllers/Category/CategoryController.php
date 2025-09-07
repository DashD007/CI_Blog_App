<?php

namespace App\Controllers\Category;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Category\Category;

class CategoryController extends BaseController
{   
    public function categorymaster()
    {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $category = new Category();

        $categories = $category->asObject()->findAll();

        return view('categories/category.php',compact('categories'));
    }

    public function createView(){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        return view("categories/create");
    }


    public function create(){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        $category = new Category();

        $data = [
            "name" => $this->request->getPost('name'),
        ];

        $category->save($data);

        if($category){
            return redirect()->to(base_url("/category"))->with("create","Category created successfully");
        }
    }

    public function delete($id){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        $category = new Category();


        $category->delete($id);

        if($category){
            return redirect()->to(base_url("/category"))->with("delete","Category deleted successfully");
        }
    }


    public function updateView($id){
        $category = new Category();

        $data = $category->asObject()->find($id);
        return view("categories/update",compact('data'));
    }


    public function update($id){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        
        $category = new Category();

        $data = [
            "name" => $this->request->getPost('name'),
        ];

        $category->update($id,$data);

        if($category){
            return redirect()->to(base_url("/category"))->with("update","Category updated successfully");
        }
    }

}
