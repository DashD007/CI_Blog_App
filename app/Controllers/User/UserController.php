<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use Config\Database;
use App\Models\Role\Role;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Exceptions\ValidationException;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Traits\Viewable;
use CodeIgniter\Shield\Validation\ValidationRules;
use Psr\Log\LoggerInterface;
use CodeIgniter\Events\Events;

class UserController extends BaseController
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

        $users = $this->db->query('SELECT u.id,u.username as `username` ,ai.secret as `email` ,r.name as `role`, u.created_at as created_at FROM `users` u INNER JOIN `auth_identities` ai on u.id = ai.user_id LEFT JOIN `roles` r on u.role_id = r.id where ai.type = "email_password";')->getResult();
    

        return view('users/usermaster.php',compact('users'));
    }

    public function createView(){
        $role = new Role();
        $roles = $role->asObject()->findAll();
        return view('users/create',compact('roles'));
    }

    public function create(){
        // Check if registration is allowed

        $users = $this->getUserProvider();

        // Validate here first, since some things,
        // like the password, can only be validated properly here.
        $rules = $this->getValidationRules();

        if (! $this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the user
        $allowedPostFields = array_keys($rules);
        $user              = $users->createNewUser($this->request->getPost($allowedPostFields));

        // Workaround for email only registration/login
        if ($user->username === null) {
            $user->username = null;
        }

        try {
            $users->save($user);
        } catch (ValidationException) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        Events::trigger('register', $user);

        // /** @var Session $authenticator */
        // $authenticator = auth('session')->getAuthenticator();

        // $authenticator->startLogin($user);

        // // If an action has been defined for register, start it up.
        // $hasAction = $authenticator->startUpAction('register', $user);
        // if ($hasAction) {
        //     return redirect()->route('auth-action-show');
        // }

        // // Set the user active
        // $user->activate();

        // $authenticator->completeLogin($user);

        // Success!
        return redirect()->to(base_url("/user/create"))
            ->with('msg', "User created successfully");
    }

    protected function getUserProvider(): UserModel
    {
        $provider = model(setting('Auth.userProvider'));

        assert($provider instanceof UserModel, 'Config Auth.userProvider is not a valid UserProvider.');

        return $provider;
    }

    protected function getUserEntity(): User
    {
        $userProvider = $this->getUserProvider();

        return $userProvider->createNewUser();
    }

    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();
    }


    public function updateView($id){
        
        $user = $this->db->query('SELECT u.id,u.username as `username` ,ai.secret as `email`,u.role_id as `role_id` FROM `users` u INNER JOIN `auth_identities` ai on u.id = ai.user_id where ai.type = "email_password" and u.id = ' . "$id" . ';')->getResult()[0];

        $role = new Role();
        $roles = $role->asObject()->findAll();

        return view('users/update',compact('roles','user'));
    }

    public function update($id){
        
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $roleId = $this->request->getPost('roleId');

        $this->db->query("UPDATE users SET username = '{$username}', role_id = '{$roleId}' WHERE users.id = '{$id}' ;");
        $this->db->query("UPDATE `auth_identities` ai SET secret = '{$email}' where `type` = 'email_password' and ai.user_id = '{$id}' ;");

        return redirect()->to(base_url("user/update/{$id}"))->with("msg","User Updated Successfully");
    }

    public function delete($id){
        $this->db->query("DELETE * FROM  users WHERE users.id = '{$id}' ;");
        $this->db->query("DELETE * FROM `auth_identities` user_id = '{$id}' ;");

        return redirect()->to(base_url("user"))->with("msg","User deleted Successfully");
    }
}
