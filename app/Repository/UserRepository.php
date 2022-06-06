<?php
/**
 * Created by PhpStorm.
 * User: aminur
 * Date: 8/24/21
 * Time: 5:41 PM
 */

namespace App\Repository;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserInterface
{
    public function all()
    {
        // TODO: Implement all() method.
        return User::get();
    }

    public function store(array $data)
    {
        // TODO: Implement store() method.

        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();

    }

    public function edit($id)
    {
        // TODO: Implement edit() method.

        try{
            $user =  User::findOrfail($id);

            return response()->json([
                'user' => $user,
                'status_code' => 200
            ],Response::HTTP_OK);

        }catch (\Exception $exception){
            return response()->json([
                'message' => 'No data found',
                'status_code' => 500
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }



    }

    public function update(array $data, $id)
    {
        // TODO: Implement update() method.

        if ($id != null)
        {
            DB::beginTransaction();

            try{

                $user = User::findOrFail($id);

                $user->name = $data['name'];
                $user->email = $data['email'];
                if ($data['password'] == '') {
                    $user->update($data->except('password'));
                }else{
                    $user->password = bcrypt($data['password']);
                }

                $user->save();

                DB::commit();

                return \response()->json([
                    'message' => 'User updated successful',
                    'status_code' => 200
                ],Response::HTTP_OK);

            }catch (\Exception $exception){
                DB::rollBack();

                $error = $exception->getMessage();

                return \response()->json([
                    'error' => $error,
                    'status_code' => 500
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.

        User::destroy($id);

        return \response()->json([
            'message' => 'User destroy successful',
            'status_code' => 200
        ],Response::HTTP_OK);
    }
}