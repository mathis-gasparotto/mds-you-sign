<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
{
  public function show(): View{
      $users = User::where('role','student')->orWhere('role','teacher')->orderBy('last_name')->get();
      return view('list-account', ['users' => $users]);
  }
    public function destroy(Request $request): View{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
          $user_to_delete = User::find($request->id);
          $user_to_delete->delete();
          $users = User::where('role','student')->orWhere('role','teacher')->orderBy('last_name')->get();
        return view('list-account', ['users' => $users]);
    }
    public function update(ProfileUpdateRequest $request): View{
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
}
