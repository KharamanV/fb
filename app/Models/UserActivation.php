<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TokenActivation;

class UserActivation extends Model
{
    use TokenActivation;

	protected $table = 'user_activations';

    protected $resendAfter = 2;

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
