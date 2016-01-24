<?php  namespace LaravelAcl\Authentication\Controllers;

/**
 * Class UserController
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
use LaravelAcl\Order;
use LaravelAcl\Item;
use LaravelAcl\Spares;
use Illuminate\Http\Request;
use Validator;
use Session;

class OrderController extends Controller 
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
		if ($this->salesman)
		{
			// get all the Order
			$orders = Order::all();

			// load the view and pass the Order
			return View::make('order.index')->with('orders', $orders);
		}
		else
		{
			return Redirect::route("user.signup-success");
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
	$spares = Spares::lists('spar', 'id');
	return View::make('order.create')->with('spares', $spares);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
	{
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'spares_id'       => 'required',
	    //'quantity' => 'required|numeric'
        );
	foreach(Input::get('quantity') as $key => $val)
	{
		$rules['quantity.'.$key] = 'required|numeric';
	}
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('order/create')
                ->withErrors($validator)
                ->withInput(Input::except('quantity'));
        } else {
            // store
            $order = new order;
            $order->save();
		$id = $order->id;
	    $quantity = Input::get('quantity');
		$spares_id = Input::get('spares_id');

	foreach($quantity as $key => $val)
	{
		$item = new Item;
            $item->spares_id       = $spares_id[$key];
            $item->quantity      = $quantity[$key];
	$item->order_id      = $id;
            //$Order->note = Input::get('note');
            echo $item->save();
	}
            Session::flash('message', 'Successfully created Order!');
            return Redirect::to('order');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
		$order = Order::find($id);
		$order_item = Item::where('order_id', $id)->select( 'item.quantity', 'spares.spar')->join('spares', 'item.spares_id', '=', 'spares.id')->get();
	$data = array(
	   'order'  => $order,
	   'order_item'  => $order_item,
	);
		return View::make('order.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }
} 
