<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TokenActivation;

class UserActivation extends Model
{
    use TokenActivation;

    /** @var string The table associated with the model. */
	protected $table = 'user_activations';

    /** @var int Amount of hours, during user cant resend email */
    protected $resendAfter = 2;

    /**
     * Activates user by specified token
     *
     * @param string $token
     * @return \App\Models\User $user User model
     */
    public function activateUser($token)
    {
        $activation = $this->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::findOrFail($activation->user_id);
        $user->is_active = 1;
        $user->save();
       
        $this->deleteActivation($token);

        return $user;
    }
}
