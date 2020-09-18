<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PaymentNotifications;
use Illuminate\Support\Facades\Auth;

class PaymentNotificationsController extends Controller
{
    const MODULE = 'payment_notifications';

    public function index(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        if ($request->filled('keyword')) :
            $payment_notifications = PaymentNotifications::getDataByKeyword($request->keyword)->get();
        else :
            $payment_notifications = PaymentNotifications::limit(50)->orderBy('updated_at', 'desc')->get();
        endif;

        return view('backend.payment_notifications.index', compact('payment_notifications'));
    }

    public function create()
    {
        $this->authorize(mapPermission(self::MODULE));
        $payment_notification = new PaymentNotifications;

        return view('backend.payment_notifications.create', compact('payment_notification'));
    }

    public function store(Request $request)
    {
        $this->authorize(mapPermission(self::MODULE));
        $payment_notification = PaymentNotifications::create($this->validateRequest());

        return redirect(route('backend.payment_notifications.index'));
    }

    public function edit(PaymentNotifications $payment_notification)
    {
        $this->authorize(mapPermission(self::MODULE));

        return view('backend.payment_notifications.update', compact('payment_notification'));
    }

    public function update(Request $request, PaymentNotifications $payment_notification)
    {
        $this->authorize(mapPermission(self::MODULE));
        $payment_notification->update($this->validateRequest());

        return redirect(route('backend.payment_notifications.index'));
    }

    public function destroy(PaymentNotifications $payment_notification)
    {
        $this->authorize(mapPermission(self::MODULE));
        $payment_notification->delete();

        return redirect(route('backend.payment_notifications.index'));
    }

    private function validateRequest()
    {
        $validatedData = request()->validate([
            "name_th" => "required",
            "name_en" => "required",
        ]);

        $validatedData['updated_by'] = Auth::id();

        if (request()->route()->getActionMethod() == 'store') :

            $validatedData['created_by'] = Auth::id();

        endif;

        return $validatedData;
    }
}
