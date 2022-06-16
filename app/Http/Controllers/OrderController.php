<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('orders.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        if($order->hasStatus('Created')){
            sleep(3);
            $placetopay = new PlacetoPay([
                'login' => config('site.login'), // Provided by PlacetoPay
                'tranKey' => config('site.key'), // Provided by PlacetoPay
                'baseUrl' => config('site.checkout_url'),
                'timeout' => 10, // (optional) 15 by default
            ]);
            $response = $placetopay->query($order->getData('transaction.request_id'));
            if ($response->isSuccessful()) {
                if ($response->status()->isApproved()) {
                    $order->setStatus(Str::slug('Payed'));
                }
            }
        }
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *me
     * @param Order $order
     * @return View|RedirectResponse
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }
}
