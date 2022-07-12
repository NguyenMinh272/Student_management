<?php

namespace App\Http\Controllers;


use App\Models\User;
use Socialite;
use Illuminate\Support\Facades\Auth;
use DB;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $user = Socialite::driver($provider)->stateless()->user();

        $account = User::where('provider_id', $user->getId())->first();

        if (empty($account)) {
            $account = new User([
                'name' => $user->name,
                'email' => $user->email,
                'provider_id' => $user->getId(),
                'provider' => $provider,
            ]);

            $account->save();

            if (!$account->save()) {
                throw new \Exception('Create user failed due to DB Error...');
            }
        }

        Auth::loginUsingId($account->id);
        return redirect()
            ->to('/students')
            ->with('success', 'Login successfully!');

    }
}
