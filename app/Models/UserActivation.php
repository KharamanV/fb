<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserActivation extends Model
{

	protected $table = 'user_activations';

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

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    public function hasActivation($userId)
    {
        return DB::table($this->table)->where('user_id', $userId)->first();
    }
}
