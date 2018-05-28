<?php

namespace App\Http\Controllers;

use App\Month;
use App\Order;
use App\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Rap2hpoutre\FastExcel\FastExcel;

class OrderController extends Controller
{
    protected $months;

    public function  __construct()
    {
        $this->middleware('auth');

        $this->months = Month::all();
        View::share('months', $this->months);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all();
        $orders = Order::paginate(15);
        return view('order.index', compact('orders', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('order.create', compact( 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'town' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'product' => 'required',
            'specific' => '',
            'note' => '',
            'status_id' => 'required',
            'date' => 'required'
        ]);

       $order = new Order($request->all());
        \Session::flash('alert-success','Order inserted successfully.');
       $order->save();
       return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $statuses = Status::all();
        return view('order.edit', compact('order', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'town' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'product' => 'required',
            'specific' => '',
            'note' => '',
            'status_id' => 'required',
            'date' => 'required'
        ]);
        $order = Order::find($order->id);
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->town = $request->town;
        $order->quantity = $request->quantity;
        $order->price = $request->price;
        $order->product = $request->product;
        $order->status_id = $request->status_id;
        $order->specific = $request->specific;
        $order->note = $request->note;
        $order->save();
        \Session::flash('alert-success','Data updated successfully.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        \Session::flash('alert-success','Order deleted successfully.');
        return redirect()->back();
    }


    public function downloadExcel()
    {
        return \Excel::download( new \App\Exports\OrdersExport, 'orders.xlsx');
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            $file = $request->file('import_file');
            (new FastExcel)->import($file, function ($line){
                return Order::create([
                    'note' =>  $line['Note'],
                    'name' => $line['Name'],
                    'phone' => $line['Phone'],
                    'address' => $line['Address'],
                    'city' => $line['City'],
                    'town' => $line['Town'],
                    'quantity' => $line['Quantity'],
                    'price' => $line['Price'],
                    'product' => $line['Product'],
                    'specific' => $line['Specific'],
                    'date' => $line['Date'],
                ]);
            });
            \Session::flash('alert-success','Data imported successfully.');
        }
        return back();
    }

    public function search(Request $request) {
        if ($request->ajax()){
            $orders = Order::where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                ->orWhere('city', 'LIKE', '%'.$request->search.'%')
                ->orWhere('town', 'LIKE', '%'.$request->search.'%')
                ->orWhere('address', 'LIKE', '%'.$request->search.'%')
                ->orWhere('name', 'LIKE', '%'.$request->search.'%')->get();
            if ($orders){
                $output='';
                foreach ($orders as $order){
                    $output.= "<tr>
                            <td><input value='{$order->id}' type='checkbox'></td>
                            <td>{$order->date }</td>
                            <td>{$order->id}</td>
                            <td>{$order->name}</td>
                            <td>{$order->phone}</td>
                            <td>{$order->address}</td>
                            <td>{$order->city}</td>
                            <td>{$order->town}</td>
                            <td>{$order->quantity}</td>
                            <td>{$order->price}</td>
                            <td>{$order->product}</td>
                            <td>{$order->specific}</td>
                            <td>{$order->note}</td>
                            <td>{$order->status->name}</td>
                            </tr>";
                }
                return $output;
            }

        }
       return response('No results fond');
    }

    public function realSearch(Request $request) {
        if ($request->search || $request->status || $request->month) {
            $statuses = Status::all();
        }
        if ($request->search){
            $orders = Order::where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('name', 'LIKE', '%'.$request->search.'%')
                ->orWhere('phone', 'LIKE', '%'.$request->search.'%')
                ->orWhere('city', 'LIKE', '%'.$request->search.'%')
                ->orWhere('town', 'LIKE', '%'.$request->search.'%')
                ->orWhere('address', 'LIKE', '%'.$request->search.'%')
                ->orWhere('name', 'LIKE', '%'.$request->search.'%')->paginate(15);

            return view('order.index', compact('orders', 'statuses'));
        }
        elseif ($request->status) {
            $orders = Order::where('status_id', $request->status)->paginate(15);
            return view('order.index', compact('orders', 'statuses'));
        }
        elseif ($request->month) {
            $orders = Order::whereMonth('date', $request->month)
                ->whereYear('date', Carbon::now()->year)->paginate(15);
//            dd($orders);
            return view('order.index', compact('orders', 'statuses'));
        }

        return back();
    }
}















