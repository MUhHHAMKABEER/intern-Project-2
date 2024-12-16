<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        // If the user has already verified their email, redirect them to the dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard', ['id' => $request->user()->id]);
        }

        // If not, send the email verification notification
        $request->user()->sendEmailVerificationNotification();

        // Redirect back with a success status
        return back()->with('status', 'verification-link-sent');
    }
}
