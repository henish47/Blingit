<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\User;
use App\Mail\NewCouponMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons', compact('coupons'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:20',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        $coupon = Coupon::create($validated);

        // Send email to all active users
        if ($coupon->status) {
            $activeUsers = User::whereNotNull('email_verified_at')->get();
            foreach ($activeUsers as $user) {
                Mail::to($user->email)->send(new NewCouponMail($coupon));
            }
        }

        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon created and notification sent to active users!');
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:20|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'expires_at' => 'nullable|date',
            'status' => 'required|boolean',
        ]);

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons.index')
                         ->with('success', 'Coupon deleted successfully!');
    }
}
