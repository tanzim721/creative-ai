<?php
namespace App\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\User;
use App\Models\Subuser;
use Illuminate\Support\Facades\Hash;

class MultiUserProvider extends EloquentUserProvider
{
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) || 
           (count($credentials) === 1 && str_contains(array_keys($credentials)[0], 'password'))) {
            return;
        }

        // First try to find in users table
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user) {
            return $user;
        }

        // Then try subusers table
        $subuser = Subuser::where('email', $credentials['email'])->first();
        
        if ($subuser && $subuser->is_active) {
            return $subuser;
        }

        return null;
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // Check if subuser is active
        if ($user instanceof Subuser && !$user->is_active) {
            return false;
        }

        return Hash::check($credentials['password'], $user->getAuthPassword());
    }
}