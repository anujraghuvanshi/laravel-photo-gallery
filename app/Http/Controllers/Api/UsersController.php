<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Validator;

class UsersController extends Controller
{
	public function __construct(UserRepository $userRepo)
	{
		$this->userRepo = $userRepo; 
	}

	/** [index all users listing] */
	public function index()
	{
		$users = User::all();

		//value return
		return response()->json([
			'errors' => 'false',
			'success' => 'success',
			'message' => 'users',
			'status' => 200,
			'users' => $users,
		], 200);
	}

	/** [userById user list by id] */
	public function userById($id)
	{
		$user = User::findOrfail($id);
		
		//value return 
		return response()->json([
			'errors' => 'false',
			'success' => 'success',
			'message' => 'user',
			'status' => 200,
			'user' => $user,
		], 200);
	}

	/** [use for stor user ] */
    public function store()
    {
    	//get request
        // dd("anuj singh is  working here");
        $user = request()->all();

    	//validation
    	$validation = validator::make($user, [

    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	// check value
    	if($validation->fails()){
    		return response()->json([
    			'errors' => 'true',
    			'status' => 401,
    			'user' => $validation->errors(),
    		], 401);
    	}

    	//user value send repository
    	$userData = $this->userRepo->userCreate($user);

        // dd($userData);
    	//create response
    	if($userData) {
			return response()->json([
				'errors' => 'false',
				'success' => 'success',
				'status' => 200,
				'user' => $userData,
			], 200);
		}
    }

    public function userUpdate(Request $request, $id)
    {
    	$validation = validator::make($request->all(), [
    		'first_name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required',
    		'password' => 'required',
    	]);

    	// check value
    	if($validation->fails()){
    		return response()->json([
    			'errors' => 'true',
    			'status' => 401,
    			'user' => $validation->errors(),
    		], 401);
    	}

    	$user = $this->userRepo->update($request, $id);

    	return response()->json([
    		'errors' => 'false',
    		'success' => 'success',
    		'message' => 'updated',
    		'status' => 200,
    		'user' => $user,
    	], 200);
    }

    /** this function use for delete */
    public function distroy($id)
    {
    	$user = $this->userRepo->delete($id);

    	if($user->delete())
    	{
    		return response()->json([
    			'errors' => 'false',
    			'success' => 'success',
    			'message' => 'deleted',
    			'status' => '200',
    		], 200);
    	}
    }

    public function login(Request $request)
    {
        // grab credentials from the request
        
        $credentials = $request->only('email', 'password');
        try {
            // dd("$2y$10$TWYUL3NEorCUmZZYK8QbnelyeeBmyYnMqawQNaRM3Wt8aH6aAuZIq");
            // attempt to verify the credentials and create a token for the user
            // dd(JWTAuth::attempt($credentials));
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 412);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'), $credentials);
    }

}
