<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Traits\TokenActivation;

class EmailReset extends Model
{
    use TokenActivation;

    /** @var string The table associated with the model. */
    protected $table = 'email_resets';

    /** @var int Amount of hours, during user cant resend email */
    protected $resendAfter = 1;

    /** @var int Amount of hours after which expires email validity */
    protected $expirationTime = 24;

    /**
     * Creates token by user id and email
     *
     * @param int $userId Id of user
     * @param string $newEmail New email
     * @return string Token string
     */
    private function createToken($userId, $newEmail)
    {
        $token = $this->getToken();
        
        DB::table($this->table)->insert([
            'user_id' => $userId,
            'token' => $token,
            'new_email' => $newEmail,
            'created_at' => new Carbon()
        ]);
        
        return $token;
    }

    /**
     * Regenerates token by user id
     *
     * @param int $userId Id of user
     * @return string Token string
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
     * Determines to create or regenerate token, and create activation record
     *
     * @param int $userId Id of user
     * @param string $newEmail New email
     * @return string Token string
     */
    public function createActivation($userId, $newEmail)
    {
        if (!$this->getActivation($userId)) {
            return $this->createToken($userId, $newEmail);
        }
        
        return $this->regenerateToken($userId);
    }

}
