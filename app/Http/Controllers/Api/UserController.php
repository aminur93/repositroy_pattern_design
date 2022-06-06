<?php

namespace App\Http\Controllers\Api;

use App\Events\NewCustomerHasregisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeNewUserMail;
use App\Repository\UserInterface;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    protected $user;

    function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        //get all user from database

        $users = $this->user->all();

        return response()->json([
            'users' => $users,
            'status_code' => 200
        ],Response::HTTP_OK);
    }

    public function create(UserRequest $request)
    {
        //store user

        if ($request->isMethod('post')){

            DB::beginTransaction();

            try{

                $this->user->store($request->validated());

                event(new NewCustomerHasregisterEvent($request->email));

                DB::commit();

                return \response()->json([
                    'message' => 'User create successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (\Exception $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    }

    public function edit($id)
    {
        //edit user


        $user = $this->user->edit($id);

        return $user;
    }

    public function update(UserRequest $request, $id)
    {
        //update user

        $data = $request->validated();

        $user = $this->user->update($data, $id);

        return $user;
    }

    public function destroy($id)
    {
        //delete user from database

        $user = $this->user->destroy($id);

        return $user;
    }
}
