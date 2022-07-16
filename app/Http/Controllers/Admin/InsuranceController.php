<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInsuranceRequest;
use App\Models\Image;
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
    public function store(StoreInsuranceRequest $request)
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
        $insurance->linkYoutube = $request->linkYoutube;
        $insurance->unit = $request->unit;


        $insurance_images = [];
        if ($request->hasFile('photo_CMND_photo_contract')) {
            $photo_CMND_photo_contract                  = $request->photo_CMND_photo_contract;
            foreach ($photo_CMND_photo_contract as $key => $image) {
                //tạo file upload trong public để chạy ảnh
                $path               = 'upload';
                $get_name_image     = $image->getClientOriginalName(); //abc.jpg
                //explode "." [abc,jpg]
                $name_image         = current(explode('.', $get_name_image));
                //trả về phần tử thứ 1 của mản -> abc
                //getClientOriginalExtension: tra ve  đuôi ảnh
                $new_image          = $name_image . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                //abc nối số ngẫu nhiên từ 0-99, nối "." ->đuôi file jpg
                $image->move($path, $new_image); //chuyển file ảnh tới thư mục
                $insurance_images[] = '/upload/' . $new_image;
            }
        }

        try {
            $insurance->save();
            if (count($insurance_images)) {
                foreach ($insurance_images as $insurance_image) {
                    $InsuranceImage = new Image();
                    $InsuranceImage->Insurance_id = $insurance->id;
                    $InsuranceImage->photo_CMND_photo_contract = $insurance_image;
                    // dd($InsuranceImage);
                    $InsuranceImage->save();
                }
            }
            Session::flash('success', 'Thêm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Thêm ' . $request->name  .  ' không thành công');
            return back();
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
    public function edit($id)
    {
        $insurance = Insurance::find($id);
        $insurances = Insurance::all();
        // $this->authorize('update', $product);
        $params = [
            'insurance' => $insurance,
            'insurances' => $insurances
        ];
        return view('admin.insurances.edit', $params);
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
        $insurance->linkYoutube = $request->linkYoutube;
        $insurance->unit = $request->unit;

        if ($request->hasFile('photo_contract')) {
            $photo_contract = $request->file('photo_contract');
            $storedPath = $photo_contract->move('uploadContract', $photo_contract->getClientOriginalName());
            $insurance->photo_contract           = 'uploadContract/' . $photo_contract->getClientOriginalName();
        }
        if ($request->hasFile('photo_CMND')) {
            $photo_CMND = $request->file('photo_CMND');
            $storedPath = $photo_CMND->move('uploadCMND', $photo_CMND->getClientOriginalName());
            $insurance->photo_CMND           = 'uploadCMND/' . $photo_CMND->getClientOriginalName();
        }
        try {
            $insurance->save();
            Session::flash('success', 'Sửa' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Session::flash('error', 'Sửa ' . $request->name  .  ' không thành công');
        }
        return redirect()->route('insurances.index');
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
