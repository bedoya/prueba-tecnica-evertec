<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Dnetix\Redirection\Exceptions\PlacetoPayException;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
    public function show(Order $order)
    {
        sleep(3);
        if ($order->hasStatus('Created')) {
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
                } elseif ($response->status()->isRejected()) {
                    $order->setStatus(Str::slug('Rejected'));
                }
            }
        }
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return View
     */
    public function edit(Order $order): View
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Tries to process again the order that is pending
     *
     * @param Order $order
     *
     * @return Redirector|RedirectResponse
     *
     * @throws PlacetoPayException
     */
    public function update(Order $order): Redirector|RedirectResponse
    {
        if ($order->hasStatus('Created')) {
            $order->prepareCheckout();
            if($order->canBeProcessed()){
                return redirect($order->getProcessUrl());
            }
        }
        return redirect()->route('products.index')->with('message', __('Su transacción no se puede iniciar'));
    }
}
