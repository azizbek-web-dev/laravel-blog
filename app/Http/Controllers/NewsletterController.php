<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Newsletter;

/**
 * Newsletter Controller
 * 
 * Handles newsletter subscription and unsubscription functionality
 * for visitors to manage their email preferences.
 */
class NewsletterController extends Controller
{
    /**
     * Subscribe a user to the newsletter
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function subscribe(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        Newsletter::create([
            'email' => $request->email,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully subscribed to newsletter!'
        ]);
    }

    /**
     * Unsubscribe a user from the newsletter
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function unsubscribe(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:newsletters,email'
        ]);

        $newsletter = Newsletter::where('email', $request->email)->first();
        
        if ($newsletter) {
            $newsletter->update([
                'is_active' => false,
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Successfully unsubscribed from newsletter!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Email not found in newsletter subscriptions.'
        ], 404);
    }
}
