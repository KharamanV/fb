<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use App\Helpers\ImageHelper;
use App\Mail\EmailChange;
use App\Models\EmailReset;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;



class CabinetController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Shows the current user cabinet
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$user = Auth::user();

    	return view('cabinet.index', ['user' => $user]);
    }

    /**
     * Updating account data
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'last_name' => 'required|max:255',
            'age'       => 'integer|min:12|max:100',
            'avatar'    => 'sometimes|image|max:1024'
        ]);

    	$user = $request->user();
        $oldName = $user->avatar;
        $user->fill($request->all());
        $user->age = ($request->age) ? (int) $request->age : null;

        if ($request->hasFile('avatar')) {
            $user->avatar = ImageHelper::uploadAvatar($request->file('avatar'));
            if ($oldName) {
                ImageHelper::deleteAvatar($oldName);
            }
        }

    	$user->save();

    	return back()->with('success', 'Информация изменена');
    }

    /**
     * Change password of current user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:6|confirmed'
        ]);

        $user = $request->user();

        if (Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->new_password);

            return redirect()->back()->with('success', 'Пароль успешно изменен');
        }
    }

    /**
     * Sends reset link to email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetEmailLink(Request $request)
    {
        $this->validate($request, ['new_email' => 'required|email|unique:users,email']);

        $reset = new EmailReset;
        $user = $request->user();
        
        if (!$reset->shouldSend($user->id)) {
            return redirect()->back()->with('info', 'На ваш новый почтовый адрес уже было отправлено письмо с активацией нового email');
        }

        $newEmail = $request->new_email;
        $token = $reset->createActivation($user->id, $newEmail);
        $link = route('email.token', $token);
        
        Mail::to($newEmail)->send(new EmailChange($link));

        return redirect()->back()->with('success', 'На ваш новый адрес, было отправлено письмо с ссылкой для подтверждения');
    }

    /**
     * Confirms email change by token from new email
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $token Token, which will confirm email change
     * @return \Illuminate\Http\Response
     */
    public function confirmChangeEmail(Request $request, $token)
    {
        $reset = new EmailReset;
        $activation = $reset->getActivationByToken($token);
        
        if (!$activation || !$reset->isActive($activation)) {
            abort(404);
        }
        
        session(['user_id' => $activation->user_id, 'new_email' => $activation->new_email]);

        return view('cabinet.confirm_email_change');
    }

    /**
     * Change email
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeEmail(Request $request)
    { 
        if (!session('user_id') || !session('new_email')) {
            abort(403, 'Время сессии истекло или вам запрещено это действие');
        }

        $this->validate($request, ['password' => 'required|max:255|min:6|confirmed']);
        $user = User::find(session('user_id'));

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('failure', 'Неверный пароль');
        }

        $user->email = session('new_email');
        $user->save();
        $reset = new EmailReset;
        $reset->deleteActivationByUserId($user->id);
        $request->session()->forget(['user_id', 'new_email']);

        return redirect()->route('cabinet.index')->with('success', 'Почтовый адрес успешно изменен');
    }

    /**
     * Shows on which tags user has subscribed
     *
     * @return \Illuminate\Http\Response
     */
    public function showSubscribeSettings()
    {
        $tags = Tag::all();
        $userTags = Auth::user()->tags;
        
        return view('cabinet.subscribes', ['tags' => $tags, 'userTags' => $userTags]);
    }

    /**
     * Updates info about subscribes
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTags(Request $request)
    {
        $this->validate($request, ['tags' => 'array']);
        $user = $request->user();
        
        if ($request->tags) {
            $user->tags()->sync($request->tags);
        } else {
            $user->tags()->detach();
        }

        return redirect()->route('cabinet.index')->with('success', 'Подписка была успешно изменена');


    }

    




}