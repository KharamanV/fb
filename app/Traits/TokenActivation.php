<?php 

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait TokenActivation
{
    /**
     * Generates and returning token
     *
     * @return string
     */
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * Inserts record to db and generate token
     *
     * @param int $userId User id
     * @return string
     */
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

    /**
     * Update record db and regenerate token
     *
     * @param int $userId User id
     * @return string
     */
    private function regenerateToken($userId)
    {
        $token = $this->getToken();
        
        DB::table($this->table)->where('user_id', $userId)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        
        return $token;
    }

    /**
     * Checks, is need to insert or update record
     *
     * @param int $userId User id
     * @return string
     */
    public function createActivation($userId)
    {
        if (!$this->getActivation($userId)) {
            return $this->createToken($userId);
        }
        
        return $this->regenerateToken($userId);
    }

    /**
     * Get activation from db by user id
     *
     * @param int $userId User id
     * @return TokenActivation
     */
    public function getActivation($userId)
    {
        return DB::table($this->table)->where('user_id', $userId)->first();
    }

    /**
     * Get activation from db by token
     *
     * @param string $token
     * @return TokenActivation
     */
    public function getActivationByToken($token)
    {
        return DB::table($this->table)->where('token', $token)->first();
    }

    /**
     * Removes activation from db by token
     *
     * @param string $token
     * @return boolean
     */
    public function deleteActivation($token)
    {
        DB::table($this->table)->where('token', $token)->delete();
    }

    /**
     * Removes activation from db by user id
     *
     * @param int $userId
     * @return boolean
     */
    public function deleteActivationByUserId($userId)
    {
        DB::table($this->table)->where('user_id', $userId)->delete();
    }

    /**
     * Checks, is need to send activation to user
     *
     * @param int $userId
     * @return boolean
     */
    public function shouldSend($userId)
    {
        $activation = $this->getActivation($userId);
        
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

    /**
     * Checks, is this activation is still active
     *
     * @param TokenActivation $activation
     * @return boolean
     */
    public function isActive($activation)
    {
        return strtotime($activation->created_at) + 60 * 60 * $this->expirationTime > time();
    }

}