<?php  namespace LaravelAcl\Authentication\Controllers;

/**
 * Class UserdashController
 *
 * @author yoganand
 */
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use View, Input, Redirect, App, Config;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
use DB;
use LaravelAcl\Supply;
use LaravelAcl\Spares;
use LaravelAcl\Order;
use LaravelAcl\Cars;
use Illuminate\Http\Request;
use Validator;
use Session;

class UserdashController extends Controller 
{
    /**
     * @var \LaravelAcl\Authentication\Repository\SentryUserRepository
     */
    protected $user_repository;
    protected $user_validator;
    /**
     * @var \LaravelAcl\Authentication\Helpers\FormHelper
     */
    protected $form_helper;
    protected $profile_repository;
    protected $profile_validator;
    /**
     * @var use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
     */
    protected $auth;
    protected $register_service;
    protected $custom_profile_repository;
	protected $salesman;
	protected $manager;

    public function __construct(UserValidator $v, FormHelper $fh, UserProfileValidator $vp, AuthenticateInterface $auth)
    {
        $this->user_repository = App::make('user_repository');
        $this->user_validator = $v;
        $this->f = App::make('form_model', [$this->user_validator, $this->user_repository]);
        $this->form_helper = $fh;
        $this->profile_validator = $vp;
        $this->profile_repository = App::make('profile_repository');
        $this->auth = $auth;
        $this->register_service = App::make('register_service');
        $this->custom_profile_repository = App::make('custom_profile_repository');

		$logged_user = $this->auth->getLoggedUser();
		$json =$logged_user->user_profile()->first()->permissions;
		$user_json = json_decode($logged_user, true);
		$permissions = $user_json['permissions'];
		if (isset($permissions['_manager']))
		{
			$this->manager = $permissions['_manager'];
		}
		if (isset($permissions['_salesman']))
		{
			$this->salesman = $permissions['_salesman'];
		}
    }
	/**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$order = Order::count();
		$supply = Supply::count();
		$spares = Spares::count();
		$car =Cars::count();
		$data = array(
		   'order'  => $order,
		   'supply'  => $supply,
		   'spares'  => $spares,
		   'car'  => $car,
		);
		if ($this->manager)
		{
			return View::make('dashbord.manager')->with($data);

		}
		else if ($this->salesman)
		{
			return View::make('dashbord.salesman')->with($data);
		}
		else
		{
			return redirect('/login');
		}
    }

public function invenorylist()
{
$spares = Spares::with('supply')->get();
return View::make('spares.inventorylist')->with('spares', $spares);
	
}

public function sparedetail($id)
{

	if ($id)
	{
		$spares = Spares::find($id);

		// show the view and pass the spares to it
		return View::make('spares.sparedetail')
		->with('spares', $spares);
	}
	
}
} 
