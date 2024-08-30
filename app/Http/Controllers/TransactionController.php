<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest();
        return view('pages.transaction.index', [
            'transactions' => $transactions->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $item = Item::all();

        $savedCart = collect($request->session()->get('cart', []));
        $carts = Item::query()->whereIn('id', $savedCart->pluck('item_id'))->get();
        $carts->each(function ($cart) use ($savedCart) {
            $cart->{'qty'} = $savedCart->firstWhere('item_id', $cart->id)->qty;
        });

        return view('pages.transaction.create', [
            'carts' => $carts,
            'items' => $item
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // DB::beginTransaction();
        // try {
        // get items in cart
        $savedCart = collect($request->session()->get('cart'));

        // create new Transaction instance
        $transaction = $request->user()->transaction()->create([
            'total' => $savedCart->sum(fn($c) => $c->qty * $c->price)
        ]);

        // save item in cart to transaction
        $savedCart->each(function ($cart) use ($transaction) {
            $item = Item::findOrFail($cart->item_id);
            $transaction->items()->attach($item, [
                'qty' => $cart->qty,
                'price' => $item->price,
            ]);
        });

        // clear cart
        $request->session()->forget('cart');
        // $request->session()->flush();

        // commit save to database
        DB::commit();

        return redirect()->route('transaction.index')->with('success', 'Berhasil membuat transaksi');
        // } catch (Exception $e) {
        //     // rollback if something wrong happened
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'Terjadi Kesalahan');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function addCart(Item $item, Request $request)
    {
        // get existing cart
        $cart = collect($request->session()->get('cart'));

        // check if item is not on the cart, make new item in cart
        if ($cart->firstWhere('item_id', $item->id) == null) {
            $cart->push((object) [
                'item_id' => $item->id,
                'qty' => 1,
                'price' => $item->price,
            ]);
        } else { // otherwise add qty on existing cart
            $cart->firstWhere('item_id', $item->id)->qty += 1;
            $cart->firstWhere('item_id', $item->id)->price = $item->price * $cart->firstWhere('item_id', $item->id)->qty;
        }

        // save cart
        $request->session()->put('cart', $cart);
        $request->session()->save();

        // redirect back
        return redirect()->back()->with('success', 'Berhasil menambahkan barang ke keranjang');
    }

    /**
     * Reduce qty of selected item on cart
     */
    public function reduceCart(Item $item, Request $request)
    {
        // get existing cart
        $cart = collect($request->session()->get('cart'));

        // check if selected item is on the cart
        $selectedCart = $cart->firstOrFail(fn($c) => $c->item_id == $item->id);
        $selectedCart->qty -= 1;
        $selectedCart->price = $item->price * $selectedCart->qty;


        // save cart, if qty is less than 0, delete the instance
        $request->session()->put('cart', $cart->filter(fn($c) => $c->qty > 0));
        $request->session()->save();

        // redirect back
        return redirect()->back()->with('success', 'Berhasil menambahkan barang ke keranjang');
    }
}
