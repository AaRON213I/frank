<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Return the list of users.
     *
     * @return Illuminate\Http\Response
     */


    public function getUsers()
    {
        $users = User::all();
        return response()->json($users,200);
    }

    public function add(Request $request)
    {
        $rules = [
            'username' => 'required|max:20',
            'password' => 'required|max:20',
        ];

        $this->validate($request, $rules);
        $user = User::create($request->all());

    }
    public function index() {
        $users = User::all();
        return response()->json($users,200);
        
    }

    /**
     * Obtain and show one user.
     *
     * @return Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->successResponse($user);

        // old code
        /*
        $user = User::where('userid', $id)->first();
        if ($user) {
            return $this->successResponse($user);
        } else {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);
        }
        */
    }

    /**
     * Update an existing user.
     *
     * @return Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'max:20',
            'password' => 'max:20',
        ];

        $this->validate($request, $rules);
        $user = User::findOrFail($id);

        $user->fill($request->all());

        // if no changes happen
        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();
        return $this->successResponse($user);

        // old code
        /*
        $this->validate($request, $rules);
        $user = User::where('userid', $id)->first();
        if ($user) {
            $user->fill($request->all());
            
            // if no changes happen
            if ($user->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            
            $user->save();
            return $this->successResponse($user);
        } else {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);
        }
        */
    }

    /**
     * Remove an existing user.
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $this->successResponse($user);

        // old code
        /*
        $user = User::where('userid', $id)->first();
        if ($user) {
            $user->delete();
            return $this->successResponse($user);
        } else {
            return $this->errorResponse('User ID Does Not Exist', Response::HTTP_NOT_FOUND);
        }
        */
    }
}