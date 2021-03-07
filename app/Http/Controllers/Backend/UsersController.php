<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
  public function __construct()
  {
    $this->middleware("Admin");
    // dd($this->middleware("can:ManageUser, App/Models/User"));
    $this->middleware("can:ManageUser, App\Models\User");
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    return view("backend.users.index")->with("model", User::simplePaginate(20));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    if (Auth::user()->id == $user->id) {
      return redirect()
        ->route("users.index")
        ->with(
          "status",
          "You can not edit your own user due to possible account errors."
        );
    }

    return view("backend.users.edit", [
      "model" => $user,
      "roles" => Role::all(),
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    //
    if (Auth::user()->id == $user->id) {
      return redirect()
        ->route("users.index")
        ->with(
          "status",
          "You can not edit your own user due to possible account errors."
        );
    }

    if ($request->name != $user->name) {
      $user->name = $request->name;
    }
    if ($request->email != $user->email) {
      $user->email = $request->email;
    }

    $user->roles()->sync($request->roles);

    return redirect()
      ->route("users.index")
      ->with("status", "User: $user->name was updated.");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    //
  }
}
