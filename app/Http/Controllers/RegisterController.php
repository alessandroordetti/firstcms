<?php 

namespace App\Http\Controllers;

use App\Models\CmsMultiversityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class RegisterController extends Controller
{
    public function getPage() {
        return view('pages.register');
    }

    public function registerUser(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:cms_multiversity_users,email',
            'password' => 'required|string|min:8',
            'gruppo_id' => 'required',
            'player_id' => 'required'
        ]);

        if($validation->fails()){
            return view('pages.register')->with('response', 'Per favore, controlla i dati inseriti');
        }

        $data = $request->all();
        $newUser = new CmsMultiversityUser;
        $newUser->email= $data['email'];
        $newUser->password = Hash::make($data['password']);
        $newUser->gruppo_id= $data['gruppo_id'];
        $newUser->player_id= $data['player_id'];
        $newUser->deleted_at= 1;
        $newUser->save();

        $allUsers = CmsMultiversityUser::all();

        return view('pages.user-show', [
        'success' => 'Utente registrato',
        'newUser' => $newUser,
        ]);
    }

    public function showUser($id)
    {
        return view('pages.user-show',  ['user' => CmsMultiversityUser::findOrFail($id)]);
    }

    public function editUser($id, CmsMultiversityUser $user)
    {
        $user = CmsMultiversityUser::find($id);
        return view('pages.edit-user', ['user' => $user]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = CmsMultiversityUser::find($id);
        $data = $request->all();

        $user->email=$data['email'];
        $user->gruppo_id= $data['gruppo_id'];
        $user->player_id= $data['player_id'];
        $user->save();

        return view('pages.user-show', ['user' => $user])->with('response', 'Utente modificato correttamente');
    }

    public function deleteUser(CmsMultiversityUser $user, $id)
    {
        $deletedUser = CmsMultiversityUser::find($id);
        $deletedUser->deleted_at = 0;
        $deletedUser->save();

        $users = CmsMultiversityUser::all();

        return view('pages.users-landing', ['users' => $users])->with('deleteMessage', 'Utente rimosso correttamente');
    }
}