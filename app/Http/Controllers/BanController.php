<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Ban;
use App\Models\User;

class BanController extends Controller
{
    protected $terms = [
        ['name' => 'День',   'value' => 1],
        ['name' => 'Неделю', 'value' => 7],
        ['name' => 'Месяц',  'value' => 30],
        ['name' => 'Всегда', 'value' => null]
    ];

    public function __construct()
    {
        $this->middleware('roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bans = Ban::all();
        return view('bans.index', ['bans' => $bans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $user = User::find($userId);
        return view('bans.create', ['user' => $user, 'terms' => $this->terms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'       => 'required|integer|exists:users,id|unique:bans',
            'blocked_until' => 'integer',
            'reason'        => 'required|max:255'
        ]);

        $ban = new Ban($request->all());
        if ($request->blocked_until) {
            $time = time() + (60 * 60 * 24 * $request->blocked_until);
            $ban->blocked_until = date('Y-m-d H:i:s', $time);
        } else {
            $ban->blocked_until = null;
        }
        $ban->save();

        $user = $ban->user;
        $user->ban_id = $ban->id;
        $user->ban_counter++;
        $user->save();

        return redirect()->route('ban.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ban = Ban::find($id);
        return view('bans.show', ['ban' => $ban]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ban = Ban::find($id);
        $username = $ban->user->login;
        $ban->delete();

        return redirect()->route('ban.index')->with('success', "Пользователь <strong>$username</strong> успешно разблокирован");
    }
}
