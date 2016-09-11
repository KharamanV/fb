<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserActivation extends Model
{

	protected $table = 'user_activations';

    protected $resendAfter = 2;

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    private function createToken($userId)
    {
        $token = $this->getToken();
        DB::table($this->table)->insert([
            'user_id' => $userId,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function regenerateToken($userId)
    {

        $token = $this->getToken();
        DB::table($this->table)->where('user_id', $userId)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function createActivation($userId)
    {
        if (!$this->getActivation($userId)) {
            return $this->createToken($userId);
        }
        return $this->regenerateToken($userId);

    }

    public function getActivation($userId)
    {
        return DB::table($this->table)->where('user_id', $userId)->first();
    }

    public function getActivationByToken($token)
    {
        return DB::table($this->table)->where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        DB::table($this->table)->where('token', $token)->delete();
    }

    public function shouldSend($userId)
    {
        $activation = $this->getActivation($userId);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

    public function activateUser($token)
    {
        $activation = $this->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);
        $user->is_active = 1;
        $user->save();
        
        $this->deleteActivation($token);

        return $user;
    }
}
