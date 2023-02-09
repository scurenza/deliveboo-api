<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Exists;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $form_data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
            'VAT' => ['required', 'numeric', 'max:99999999999', 'unique:' . User::class],
            'img' => ['nullable', 'image', 'max:512'],
            'types' => ['required', 'exists:types,id']
        ]);


        $form_data['img'] = null;

        if ($request->hasFile('img')) {
            $path = Storage::put('img', $request->img);
            $form_data['img'] = $path;
        };

        // dd($form_data);


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'VAT' => $request->VAT,
            'img' => $form_data['img']
        ]);

        $user->types()->attach($request->types);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    // public function destroy(User $user)
    // {
    //     dd($user);
    //     $user->types()->detach();

    //     $user->delete();
    //     return redirect()->route('test');
    // }
}
