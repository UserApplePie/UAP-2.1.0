<?php
namespace Modules\Members\Controllers;

use Core\Controller,
    Core\View,
    Core\Router,
    Core\Error,
    Helpers\Auth\Auth as AuthHelper,
    Helpers\Csrf,
    Helpers\Request,
    Helpers\SimpleImage,
    Models\Users,
    Modules\Members\Models\Members as MembersModel;



class Members extends Controller
{
    private $auth;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->auth = new AuthHelper();
        $this->user = new Users();

        if ($this->auth->isLogged()) {
            $u_id = $this->auth->currentSessionInfo()['uid'];
            $this->user->update($u_id);
        }

        $this->user->cleanOfflineUsers();
    }

    /**
     * Routes for this Members Module
     */
    public function routes()
    {
        Router::any('members','Modules\Members\Controllers\Members@members');
        Router::any('online-members','Modules\Members\Controllers\Members@online');
        Router::any('profile/(:any)','Modules\Members\Controllers\Members@viewProfile');
        Router::any('edit-profile','Modules\Members\Controllers\Members@editProfile');
    }

    /**
     * Part of page for Member status
     */
    public function index()
    {
        $onlineUsers = new MembersModel();
        $data['activatedAccounts'] = count($onlineUsers->getActivatedAccounts());
        $data['onlineAccounts'] = count($onlineUsers->getOnlineAccounts());

        View::renderModule('Members/views/online_users',$data);
    }

    /**
     * For inserting list navbar
     */
    public function navbar()
    {
        View::renderModule('Members/views/navbar');
    }

    /**
     * Page for list of activated accounts
     */
    public function members()
    {
        $onlineUsers = new MembersModel();
        $data['title'] = 'Members';
        $data['isLoggedIn'] = $this->auth->isLogged();
        $data['members'] = $onlineUsers->getMembers();

        View::renderTemplate('header', $data);
        View::renderModule('Members/views/members', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Page for list of online accounts
     */
    public function online()
    {
        $onlineUsers = new MembersModel();
        $data['title'] = 'Members';
        $data['isLoggedIn'] = $this->auth->isLogged();
        $data['members'] = $onlineUsers->getOnlineMembers();

        View::renderTemplate('header', $data);
        View::renderModule('Members/views/members', $data);
        View::renderTemplate('footer', $data);
    }

    /**
     * Get profile by username
     * @param $username
     */
    public function viewProfile($username)
    {
        $onlineUsers = new MembersModel();
        $profile = $onlineUsers->getUserProfile($username);
        if(sizeof($profile)>0){
            $data['title'] = $username . "'s Profile";
            $data['profile'] = $profile[0];
            $data['isLoggedIn'] = $this->auth->isLogged();
            View::renderTemplate('header', $data);
            View::renderModule('Members/views/view_profile', $data);
            View::renderTemplate('footer', $data);
        }
        else
            Error::error404();
    }

    public function editProfile()
    {
        $u_id = $this->auth->currentSessionInfo()['uid'];

        $onlineUsers = new MembersModel();
        $username = $onlineUsers->getUserName($u_id);
        if(sizeof($username) > 0){

            if (isset($_POST['submit'])) {
                if(Csrf::isTokenValid()) {
                    $firstName = strip_tags(Request::post('firstName'));
                    $gender = Request::post('gender') == 'male' ? 'Male' : 'Female';
                    $website = !filter_var(Request::post('website'), FILTER_VALIDATE_URL) === false ? Request::post('website') : DIR.'profile/'.$username;
                    $aboutMe = nl2br(strip_tags(Request::post('aboutMe')));
                    $picture = file_exists($_FILES['profilePic']['tmp_name']) || is_uploaded_file($_FILES['profilePic']['tmp_name']) ? $_FILES ['profilePic'] : array ();
                    $userImage = Request::post('oldImg');

                    if(sizeof($picture)>0){
							$check = getimagesize ( $picture['tmp_name'] );

							if($picture['size'] < 1000000 && $check && $check['mime'] == "image/jpeg"){
								if(!file_exists('images/profile-pics'))
									mkdir('images/profile-pics',0777,true);

								$image = new SimpleImage($picture['tmp_name']);
								$dir = 'images/profile-pics/'.$username[0]->username.'.jpg';
								$image->best_fit(400,300)->save($dir);
								$userImage = $dir;
							}
                    }
                    $onlineUsers->updateProfile($u_id, $firstName, $gender, $website, $userImage, $aboutMe);
                    $data['message'] = "Successfully updated profile";
                    $data['type'] = "success";
                }
                else{
                    $data['message'] = "Error Updating profile";
                    $data['type'] = "error";
                }

            }

            $username = $username[0]->username;
            $profile = $onlineUsers->getUserProfile($username);


            $data['title'] = $username . "'s Profile";
            $data['profile'] = $profile[0];
            $data['isLoggedIn'] = $this->auth->isLogged();
            $data['csrf_token'] = Csrf::makeToken();
            View::renderTemplate('header', $data);
            View::renderModule('Members/views/edit_profile', $data);
            View::renderTemplate('footer', $data);
        }
        else
            Error::error404();
    }
}