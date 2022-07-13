<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Insurance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $insurances = Insurance::select('*');
        if (isset($request->filter['name']) && $request->filter['name']) {
            $name = $request->filter['name'];
            $insurances->where('name', 'LIKE', '%' . $name . '%');
        }

        $insurances->orderBy('id', 'desc');
        $insurances = $insurances->paginate(20);
        // foreach ($Insurances as $Insurance) {
        //     if ($Insurance->Insurance_type == 'Consignment') {
        //         $now = Carbon::now();
        //         $dt = Carbon::create($Insurance->Insurance_end_date);
        //         $Insurance->remaining_day = $now->diffInDays($dt);
        //     }
        // }
        $params = [
            'insurances' => $insurances,
        ];

        return view('admin.insurances.index', $params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', insurance::class);
        return view('admin.insurances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insurance = new Insurance();
        $insurance->contract = $request->contract;
        $insurance->name = $request->name;
        $insurance->phone = $request->phone;
        $insurance->email = $request->email;
        $insurance->description = $request->description;
        $insurance->contract_package = $request->contract_package;
        $insurance->total = $request->total;
        $insurance->total = Str::replace(',', '', $insurance->total);
        $insurance->paid_and_unpaid_amount = $request->paid_and_unpaid_amount;
        $insurance->insurance_start_date = $request->insurance_start_date;
        $insurance->insurance_open_date_Paid = $request->insurance_open_date_Paid;
        $insurance->insurance_start_date_payment = $request->insurance_start_date_payment;
        $insurance->photo_contract = $request->photo_contract;
        $insurance->photo_CMND = $request->photo_CMND;
        $insurance->linkYoutube = $request->linkYoutube;
        $insurance->unit = $request->unit;

        if ($request->hasFile('avatar')) {
            $photo_contract = $request->file('avatar');
            $storedPath = $photo_contract->move('avatars', $photo_contract->getClientOriginalName());
            $insurance->photo_contract           = 'avatars/' . $photo_contract->getClientOriginalName();
        }

        if ($request->hasFile('avatar')) {
            $photo_CMND = $request->file('avatar');
            $storedPath = $photo_CMND->move('avatars', $photo_CMND->getClientOriginalName());
            $insurance->photo_CMND           = 'avatars/' . $photo_CMND->getClientOriginalName();
        }
        try {
            $insurance->save();
            Session::flash('success', 'Thêm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Thêm ' . $request->name  .  ' không thành công');
        }
        return redirect()->route('insurances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $insurance = new Insurance();
        $insurance->contract = $request->contract;
        $insurance->name = $request->name;
        $insurance->phone = $request->phone;
        $insurance->email = $request->email;
        $insurance->description = $request->description;
        $insurance->contract_package = $request->contract_package;
        $insurance->total = $request->total;
        $insurance->total = Str::replace(',', '', $insurance->total);
        $insurance->paid_and_unpaid_amount = $request->paid_and_unpaid_amount;
        $insurance->insurance_start_date = $request->insurance_start_date;
        $insurance->insurance_open_date_Paid = $request->insurance_open_date_Paid;
        $insurance->insurance_start_date_payment = $request->insurance_start_date_payment;
        $insurance->photo_contract = $request->photo_contract;
        $insurance->photo_CMND = $request->photo_CMND;
        $insurance->linkYoutube = $request->linkYoutube;
        $insurance->unit = $request->unit;

        if ($request->hasFile('avatar')) {
            $photo_contract = $request->file('avatar');
            $storedPath = $photo_contract->move('avatars', $photo_contract->getClientOriginalName());
            $insurance->photo_contract           = 'avatars/' . $photo_contract->getClientOriginalName();
        }

        if ($request->hasFile('avatar')) {
            $photo_CMND = $request->file('avatar');
            $storedPath = $photo_CMND->move('avatars', $photo_CMND->getClientOriginalName());
            $insurance->photo_CMND           = 'avatars/' . $photo_CMND->getClientOriginalName();
        }
        try {
            $insurance->save();
            Session::flash('success', 'Thêm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Thêm ' . $request->name  .  ' không thành công');
        }
        return redirect()->route('insurances.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
