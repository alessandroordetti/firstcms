<?php 

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\CmsMultiversityUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CmsMultiversityUserController extends Controller
{

    public function index(){
        $users = CmsMultiversityUser::all();
        return view('pages.user-index', ['users' => $users]);
    }

    public function getRegisterPage()
    {
        return view('pages.register');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:cms_multiversity_users,email',
            'password' => 'required|string|min:8',
            'gruppo_id' => 'required',
            'player_id' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->route('register')->with('response', 'Per favore, controlla i dati inseriti');
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

        return redirect()->route('user-edit', ['id' => $newUser->id])->with(['success' => 'Utente registrato correttamente', 'newUser' => $newUser]);
    }

    public function show($id)
    {
        $user = CmsMultiversityUser::findOrFail($id);
        return redirect()->route('user-show', ['id' => $user->id]);
    }

    public function edit($id, CmsMultiversityUser $user)
    {
        $user = CmsMultiversityUser::find($id);
        return view('pages.user-edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = CmsMultiversityUser::find($id);
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'email' => 'required|email|max:255|unique:cms_multiversity_users,email',
            'password' => 'required|string|min:8',
            'gruppo_id' => 'required',
            'player_id' => 'required'
        ]);

        $user->email=$data['email'];
        $user->gruppo_id= $data['gruppo_id'];
        $user->player_id= $data['player_id'];
        $user->save();

        return redirect()->route('user-edit', ['id' => $user->id])->with('response', 'Utente modificato correttamente');
    }


    public function delete(CmsMultiversityUser $user, $id)
    {
        $deletedUser = CmsMultiversityUser::find($id);
        $deletedUser->deleted_at = 1;
        $deletedUser->save();

        return redirect()->route('user-index')->with('deleteMessage', 'Utente rimosso correttamente');
    }
}
