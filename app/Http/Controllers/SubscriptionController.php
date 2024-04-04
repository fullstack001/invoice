<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Price;
use Stripe\Invoice;
use App\Models\Subscrip;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;



class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){        
        $user = User::find(auth()->id());
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $subscrips = Subscrip::where('user_id', $user->id)->get();
            $currentPlan = Subscrip::where('user_id', $user->id)->latest()->first()->plan;            
            $invoices = Invoice::all();          

            return view('admin.subscrip', compact('subscrips', 'currentPlan', 'invoices'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function add(){
        $user = User::find(auth()->id());
        $stripeKey = config('services.stripe.key');
        $currentPlan = Subscrip::where('user_id', $user->id)->latest()->first()->plan;
        return view('admin.subscripAdd', compact('currentPlan'));
    }

    public function subscribe(Request $request){
        $user = $request->user();
        
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create customer on Stripe
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'source' => $request->stripeToken,
            ]);
          
            // Subscribe user to selected plan           
            $plan = '';
            $price_id = '';
           

            switch ($request->input('plan_id')) {
                case 24.99:
                    $plan = 'Essential';
                    $price_id = env('Plan_Essential');
                    break;
                case 49.99:
                    $plan = 'Premium';
                    $price_id = env('Plan_Premium');
                    break;

                case 99.99:
                    $plan = 'Unlimited';
                    $price_id = env('Plan_Unlimited');
                    break;
                default:
                    $plan = 'free';
                    $price_id = env('Plan_Free');
                    break;
            }            

            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [[
                    'price' => $price_id,
                    'quantity' => 1,
                ]],
            ]);          
            
            $invoices = Invoice::all(['subscription' => $subscription->id]);
           
            $subscrip = new Subscrip();

            $subscrip->user_id = $user->id;
            $subscrip->plan = $plan;
            $subscrip->price = $request->input('plan_id');
            $subscrip->stripe_id = $customer->id;
            $subscrip->stripe_subscription_id = $subscription->id;
            $subscrip->subscription_status = 'active';           

            $subscrip->save();

            $user = User::find(auth()->id());
            $subscrips = Subscrip::where('user_id', $user->id)->get();
            $currentPlan = Subscrip::where('user_id', $user->id)->latest()->first()->plan; 

            return redirect()->route('subscrip.index', compact('subscrips', 'currentPlan', 'invoices'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function downloadInvoice($invoiceId){
        Stripe::setApiKey(env('STRIPE_SECRET'));
        try {
            // Retrieve the invoice
            $invoice = Invoice::retrieve($invoiceId);    
            $client = new Client();          

            $pdf_url = $invoice->invoice_pdf;   

            $response = $client->get($pdf_url);

            $pdf = $response->getBody()->getContents();

            // Output the PDF
            header('Content-Type: application/pdf');
            echo $pdf;            
        } catch (Exception $e) {
            // Handle errors
            echo 'Error: ' . $e->getMessage();
        }
    }
}
