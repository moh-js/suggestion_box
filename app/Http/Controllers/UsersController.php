<?php

namespace App\Http\Controllers;

use App\User;
use App\Person;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{

    public function __costruct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.index', [
            'users' => User::query()->where([['id', '!=', 1], ['id', '!=', auth()->id()]])->withTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create', [
            'roles' => Role::where('name', '!=', 'super-admin')->get(),
            'persons' => Person::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'area' => ['sometimes', 'integer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'area' => $request->area,
            'password' => \bcrypt('123456'),
        ])->assignRole($request->role);

        return redirect()->route('user.index'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', [
            'roles' => Role::where('name', '!=', 'super-admin')->get(),
            'persons' => Person::all(),
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'area' => ['sometimes', 'integer'],
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'area' => $request->area,
            'password' => \bcrypt('123456'),
        ]);
        
        $user->syncRoles($request->role);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::withTrashed()->where('id', $id)->first();

        // Restore Deleted User 
        if ($user->trashed()) {
            $user->restore();
        }
        else {
            $user->delete();
        }

        return back();
    }
}
