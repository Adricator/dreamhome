<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;

class ClientAuthenticatedSessionController extends Controller
{
    /**
     * Show the client login view.
     */
    public function create()
    {
        return view('auth.client-login');
    }

    /**
     * Handle an incoming authentication request for a client.
     */
    public function store(Request $request)
    {
        // 1. Validate inputs
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->boolean('remember');

        // 2. Crucial Step: Direct Auth specifically to the 'client' guard configuration
        if (! Auth::guard('client')->attempt($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        // 3. Regenerate session on successful verification
        $request->session()->regenerate();

        // 4. Send authenticated client to their directory dashboard
        return redirect()->intended('/client/dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // 1. Explicitly clear out the active Client authentication guard data records
        Auth::guard('client')->logout();

        // 2. Invalidate the current request session from the browser context
        $request->session()->invalidate();

        // 3. Regenerate a clean CSRF token structure to secure the guest session
        $request->session()->regenerateToken();

        // 4. Force redirection back to the root website landing page (welcome.blade.php)
        return redirect('/');
    }
}