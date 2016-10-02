<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait TokenActivation
{
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

    public function deleteActivationByUserId($userId)
    {
        DB::table($this->table)->where('user_id', $userId)->delete();
    }

    public function shouldSend($userId)
    {
        $activation = $this->getActivation($userId);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }  

    public function isActive($activation)
    {
        return strtotime($activation->created_at) + 60 * 60 * $this->expirationTime > time();
    }



}