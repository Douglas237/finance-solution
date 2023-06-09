<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, StoreUserRequest $request)
    {
        $user->create($request->validated());
        $user->create([
            'name' => request('name'),
            'last_name' => request('last_name'),
            'date_naissance' => request('date_naissance'),
            'sexe' => request('sexe'),
            'cni' => request('cni'),
            'telephone' => request('telephone'),
            'password' => request('password'),
            'email' => request('email'),
            'username' => request('username'),
        ]);

        return redirect()->route('users.index')
        ->withSuccess(__('Utilisateur creer avec success.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
        'user' => $user,
        'userRole' => $user->roles->pluck('name')->toArray(),
        'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());
        $user->syncRoles($request->get('role'));

        return redirect()->route('users.index')
        ->withSuccess(__('Utilisateur modifier avec success.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
        ->withSuccess(__('Utilisateur supprimer avec success.'));
    }
}
