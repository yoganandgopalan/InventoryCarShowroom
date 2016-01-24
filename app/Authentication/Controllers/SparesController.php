<?php  namespace LaravelAcl\Authentication\Controllers;

/**
 * Class SparesController
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
use LaravelAcl\Spares;
use LaravelAcl\Supply;
use LaravelAcl\Cars;
use Illuminate\Http\Request;
use Validator;
use Session;

class SparesController extends Controller 
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
		if ($this->manager)
		{
			// get all the spares
			$spares = Spares::all();

			// load the view and pass the spares
			return View::make('spares.index')->with('spares', $spares);
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
	$cars = Cars::lists('name', 'id');
         return View::make('spares.create')->with('cars', $cars);
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
            'spar'       => 'required',
			'price' => 'required|numeric',
			'file'     => 'image|mimes:jpg,jpeg,png|min:1|max:250',
			'model'       => 'required',
			'category'       => 'required',
			'cars'       => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('spares/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {


	// upload the image //
		$file_path = 'uploads/no_image_available.png';
	$file = Input::file('file');
		if ($file)
		{
			$destination_path = 'uploads/';
			$filename = str_random(6).'_'.$file->getClientOriginalName();
			$file->move($destination_path, $filename);
			$file_path = $destination_path . $filename;
		}
            // store
            $spares = new Spares;
            $spares->spar       = Input::get('spar');
            $spares->model      = Input::get('model');
            $spares->category      = Input::get('category');
            $spares->price      = Input::get('price');
            $spares->note = Input::get('note');
	    $spares->file = $file_path; // save image data into database //
            $spares->save();

            $cars = Input::get('cars');
            $spares->cars()->sync($cars);

            // redirect
            Session::flash('message', 'Successfully created spares!');
            return Redirect::to('spares');
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
		$spares = Spares::find($id);

		// show the view and pass the spares to it
		return View::make('spares.show')
		->with('spares', $spares);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $spares = Spares::find($id);
	$cars_spares = $spares->cars->lists('id')->toArray();
	$cars = Cars::lists('name', 'id');

	$data = array(
	   'spares'  => $spares,
	   'cars'  => $cars,
	);
	return View::make('spares.edit')->with($data);
//,'cars_spares', $cars_spares
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'spar'       => 'required',
			'price' => 'required|numeric',
			'file'     => 'image|mimes:jpg,jpeg,png|min:1|max:250',
			'model'       => 'required',
			'category'       => 'required',
			'cars'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('spares/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

		// upload the image //
	$file_path = 'uploads/no_image_available.png';
	$file = Input::file('file');
		if ($file)
		{
			$destination_path = 'uploads/';
			$filename = str_random(6).'_'.$file->getClientOriginalName();
			$file->move($destination_path, $filename);
			$file_path = $destination_path . $filename;
		}

            // update
            $spares = Spares::find($id);
            $spares->spar       = Input::get('spar');
            $spares->model      = Input::get('model');
            $spares->category      = Input::get('category');
            $spares->price      = Input::get('price');
            $spares->note = Input::get('note');
	    $spares->file = $file_path; // update image data into database //
            $spares->save();

            $cars = Input::get('cars');
            $spares->cars()->sync($cars);

            // redirect
            Session::flash('message', 'Successfully updated spares!');
            return Redirect::to('spares');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
		$spares = Spares::find($id);
		$spares->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the spares!');
		return Redirect::to('spares');
    }
} 
