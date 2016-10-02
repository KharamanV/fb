<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Traits\TokenActivation;

class EmailReset extends Model
{
    use TokenActivation;

    protected $table = 'email_resets';

    protected $resendAfter = 1;

    protected $expirationTime = 24;

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

    private function regenerateToken($userId)
    {
        $token = $this->getToken();
        DB::table($this->table)->where('user_id', $userId)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    public function createActivation($userId, $newEmail)
    {
        if (!$this->getActivation($userId)) {
            return $this->createToken($userId, $newEmail);
        }
        return $this->regenerateToken($userId);
    }

}
