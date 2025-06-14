<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Project;
use Stripe\Checkout\Session;
use Stripe\Checkout\Session as StripeSession;
use Stripe\PaymentIntent;
use App\Mail\StripeReceiptMail;
use Illuminate\Support\Facades\Mail;

class PayController extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'fee' => 'required|numeric|min:1',
            'currency' => 'required|in:myr,usd', 
            'id' => 'required',
        ]);
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => $request->currency,
                    'product_data' => [
                        'name' => 'Project Payment',
                    ],
                    'unit_amount' => $request->fee * 100,
                ],
                'quantity' => 1,
            ]],
            'metadata' => [
                'project_id' => $request->id,
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.cancel'),
        ]);

        

        return redirect($session->url);
    }

    public function handleSuccess(Request $request){
        Stripe::setApiKey(config('services.stripe.secret'));

        $sessionId = $request->get('session_id');
        $session = StripeSession::retrieve($sessionId);
        $paymentIntent = PaymentIntent::retrieve($session->payment_intent);
        $charge = \Stripe\Charge::retrieve($paymentIntent->latest_charge);
        $receiptUrl = $charge->receipt_url;

        Mail::to(auth()->user()->email)->send(new StripeReceiptMail(auth()->user(), $receiptUrl));

        // Optional: validate payment status
        if ($paymentIntent->status === 'succeeded') {
            // Update your project using metadata
            $projectId = $session->metadata->project_id ?? null;

            if ($projectId) {
                $project = Project::find($projectId);

                if ($project) {
                    $project->update([
                        'receipt' => $receiptUrl,
                    ]);
                }
            }
        }

        $this->updateStatus($projectId);

        return view('checkout.success');
    }

    private function updateStatus($id){
        $project = Project::where('id', "=",$id)->first();
        if (!empty($project->receipt) && !empty($project->link)) {
            $project->update([
                'status' => 'SUBMITTED'
            ]);

            return back()->with("success","Status changed to SUBMITTED!");
        }

        return back()->with('error', 'Status still DRAFT!');
    }
}
