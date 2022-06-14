<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
        return view('orders.show');
    }

    /**
     * Show the form for editing the specified resource.
     *me
     * @param Order $order
     * @return View
     */
    public function edit(Order $order): View
    {
        return view('orders.edit');
    }
}
