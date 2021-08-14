<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $users)
    {
        $search = $request->input('search');

        $active = 'Users';
        $users = $users->when($search, function($query) use ($search) {
                    return $query->where('name', 'like', '%'.$search.'%')
                         ->orWhere('email', 'like', '%'.$search.'%');
                })
                ->paginate(10);

        $request = $request->all();
        
        return View('dashboard/user/list', [
            'users' => $users,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = USER::find($id);
        $active = 'Users';
        return View('dashboard/user/form', ['user' => $user, 'active' => $active]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = USER::find($id);

        $validator = VALIDATOR::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:App\Models\User,email,'.$id
        ]);

        if($validator->fails()){
            return redirect('dashboard/user/edit/'.$id)
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return redirect('dashboard/users');
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = USER::find($id);
        $user->delete();
        return redirect('dashboard/users');
    }
}
