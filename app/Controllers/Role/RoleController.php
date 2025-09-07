<?php

namespace App\Controllers\Role;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\Role\Role;
use App\Models\Permission\Permission;

class RoleController extends BaseController
{
    public function index()
    {
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }

        $role = new Role();
        $roles = $role->asObject()->findAll();

        return view('roles/role.php',compact('roles'));
    }

    public function createView(){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        return view("roles/create");
    }

    public function create(){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }


        $role = new Role();
        $permission = new Permission();

        $data1 = [
            'name' => $this->request->getPost('name'),
        ];
        

        $response1 = $role->save($data1);

        $roleId = $role->db->insertID();


        $permissions  =  array_merge(...array_filter([$this->request->getPost('users-permissions'), $this->request->getPost('roles-permissions'), $this->request->getPost('categories-permissions'),$this->request->getPost('blogs-permissions')]));
        $data2 = [];
        foreach($permissions as $perm ){
            $data2[] = ['name'=> $perm,'roleId'=>$roleId]; 
        }

        $response2 = $permission->insertBatch($data2);

        if($response1 && $response2 ){
            return redirect()->to(base_url("/role"))->with("create","Role created successfully");
        }
    }

    public function delete($id){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        
        $role = new Role();
        $permission = new Permission();


        $response = $role->delete($id);
        $permission->where('roleId', $id)->delete();
        
        if($response){
            return redirect()->to(base_url("/role"))->with("delete","Role deleted successfully");
        }
    }

    public function updateView($id){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        
        $role = new Role();
        $permission = new Permission();


        $roleData = $role->asObject()->find($id);
        $response = $permission->select('name')->where('roleId',$id)->find();
        $permissionData = [];
        foreach($response as $perm){
            $permissionData[] = $perm['name'];
        }

        return view("roles/update",compact('roleData','permissionData'));
    }


    public function update($id){
        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url("/login"));
        }
        
        $role = new Role();
        $permission = new Permission();

        $data = [
            "name" => $this->request->getPost('name'),
        ];

        // 1. update role name  
        $role->update($id,$data);

        // 2. delete all the previous permissions for that role
        $permission->where('roleId', $id)->delete();
        
        // 3. get all the checked fields from the frontend
        $permissions  =  array_merge(...array_filter([$this->request->getPost('users-permissions'), $this->request->getPost('roles-permissions'), $this->request->getPost('categories-permissions'),$this->request->getPost('blogs-permissions')]));
        
        
        $data2 = [];
        foreach($permissions as $perm ){
            $data2[] = ['name'=> $perm,'roleId'=>$id]; 
        }
        // 4. create new record for the added permissions
        $response2 = $permission->insertBatch($data2);


        if($role){
            return redirect()->to(base_url("/role"))->with("update","Role updated successfully");
        }
    }
}
