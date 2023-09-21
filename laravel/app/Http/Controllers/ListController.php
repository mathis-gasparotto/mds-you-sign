<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ListController extends Controller
{
  public function show(): View{
      $users = User::where('role','student')->orWhere('role','teacher')->orderBy('last_name')->get();
      $classes = Classe::orderBy('name')->get();
      return view('list-account', ['users' => $users, 'classes' => $classes]);
  }
    public function destroy(Request $request): View{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
          $user_to_delete = User::find($request->id);
          $user_to_delete->delete();
        $users = User::where('role','student')->orWhere('role','teacher')->orderBy('last_name')->get();
        $classes = Classe::orderBy('name')->get();
        return view('list-account', ['users' => $users, 'classes' => $classes]);
    }
    public function update(Request $request): View{
        // 'password' => ['required', 'current_password'],
         $request->validateWithBag('userUpdate', [
             'first_name' => ['required','string', 'max:255'],
             'last_name' => ['required','string', 'max:255'],
             'email' => ['email', 'max:255',Rule::unique('users')->ignore($request->id)],
        ]);

        $user_to_update = User::find($request->id);
        //$request->user()->fill($request->validated());
        if ($request->email != $user_to_update->email) {
            $user_to_update->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'email_verified_at' => null, 'role' => $request->role, 'classe_id' => $request->classe_id, 'updated_at' => now()]);
        }

        $user_to_update->update(['first_name' => $request->first_name, 'last_name' => $request->last_name,  'role' => $request->role, 'classe_id' => $request->classe_id, 'updated_at' => now()]);

        $user_to_update->save();

        $users = User::where('role','student')->orWhere('role','teacher')->orderBy('last_name')->get();
        $classes = Classe::orderBy('name')->get();
        return view('list-account', ['users' => $users, 'classes' => $classes]);
        //return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
