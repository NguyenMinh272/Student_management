<?php
//namespace  App\Classes;
//
//use App\Models\SocialAccount;
//use App\Models\User;
//use Laravel\Socialite\Contracts\User as ProviderUser;
//
//class SocialAccountService
//{
//    public function createOrGetUser(ProviderUser $providerUser)
//    {
//        $account = SocialAccount::whereProvider('facebook')
//            ->whereProviderUserId($providerUser->getId())
//            ->first();
//dd($account);
//        if ($account) {
//            return $account->user;
//        } else {
//
//            $account = new SocialAccount([
//                'provider_user_id' => $providerUser->getId(),
//                'provider' => 'facebook',
//
//            ]);
//
//            $user = User::whereEmail($providerUser->getEmail())->first();
//
//            if (!$user) {
//
//                $user = User::create([
//                    'email' => $providerUser->getEmail(),
//                    'name' => $providerUser->getName(),
//                    'password' => md5(rand(1,10000)),
//                ]);
//            }
//
//            $account->user()->associate($user);
//            $account->save();
//
//            return $user;
//        }
//    }
//}


//
//namespace App\Http\Controllers;
//
//use Socialite;
//use DB;
//use App\Classes\SocialAccountService;
//
//class SocialAuthController extends Controller
//{
//    public function redirect($provider)
//    {
//        return Socialite::driver($provider)->redirect();
//    }
//
//    /**
//     * Return a callback method from facebook api.
//     *
//     * @return callback URL from facebook
//     */
//    public function callback(SocialAccountService $service, $provider)
//    {
//        $user = $service->createOrGetUser(Socialite::driver($provider)->user());
//        auth()->login($user);
//
//        return redirect()->to('/students');
//    }
//}
