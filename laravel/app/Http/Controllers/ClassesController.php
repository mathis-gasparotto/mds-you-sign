<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClassesController extends Controller
{
    public function show(): View{
        $classes = Classe::orderBy('name')->get();
        return view('class-creator', ['classes' => $classes]);
    }

    public function destroy(Request $request): View{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $classe_to_delete = Classe::find($request->id);
        User::where('classe_id', $classe_to_delete->id)->update(['classe_id' => null]);
        $classe_to_delete->delete();
        $classes = Classe::orderBy('name')->get();
        return view('class-creator', ['classes' => $classes]);
    }
    public function update(Request $request): View{
        $request->validateWithBag('classeDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $classe_to_update = Classe::find($request->id);
        $classe_to_update->update(['name' => $request->name,'updated_at' => now()]);
        $classes = Classe::orderBy('name')->get();
        return view('class-creator', ['classes' => $classes]);
    }
    public function create(Request $request){
        $request->validateWithBag('classeCreation', [
            'password' => ['required', 'current_password'],
        ]);
        $newClasse = new Classe;
        if($request->name != null){
            $newClasse->name = $request->name;
            $newClasse->created_at = now();
            $newClasse->updated_at = now();
            $newClasse->save();
        }
        $classes = Classe::orderBy('name')->get();
        return view('class-creator', ['classes' => $classes]);

    }
}
