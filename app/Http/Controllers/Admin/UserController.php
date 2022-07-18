<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserSubmitEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostImportRequest;
use App\Models\User;
use App\Models\UserGroup;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Branch;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Excel;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function user_role(Request $request, $user_role)
    {
        $user = User::select('*');
        if ($user_role) {
            $user->where('user_group_id', $user_role);
        }
        $user->orderBy('id', 'desc');
        $users = $user->paginate(20);
        // dd($users);
        $userGroups = UserGroup::all();

        $params = [
            'users' => $users,
            'userGroups' =>  $userGroups,
            'filter' => $request->filter,
            'user_role' => $user_role
        ];
        return view('admin.users.index', $params);
    }
    public function index(Request $request)
    {

        $this->authorize('viewAny', User::class);
        $query = User::select('*');
        if (isset($request->filter['name']) && $request->filter['name']) {
            $name = $request->filter['name'];
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if (isset($request->filter['phone']) && $request->filter['phone']) {
            $phone = $request->filter['phone'];
            $query->where('phone', 'LIKE', '%' . $phone . '%');
        }
        if (isset($request->filter['user_group_id']) && $request->filter['user_group_id']) {
            $user_group_id = $request->filter['user_group_id'];
            $query->where('user_group_id', 'LIKE', '%' . $user_group_id . '%');
        }

        if ($request->s) {
            $query->where('name', 'LIKE', '%' . $request->s . '%');
            $query->orwhere('id', $request->s);
        }


        $query->orderBy('id', 'desc');
        $users = $query->paginate(20);
        // dd($users);
        $userGroups = UserGroup::all();

        $params = [
            'users' => $users,
            'userGroups' =>  $userGroups,
            'filter' => $request->filter,
            'user_role' => 'all'
        ];
        return view('admin.users.index', $params);
    }
    /**
     * Show the form for creating a new resource.
     * @return array create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class);
        $userGroups = UserGroup::all();
        $users = User::select('*');
        $users = $users->paginate(3);
        $params = [

            'userGroups' => $userGroups,
            'users' => $users
        ];
        return view('admin.users.add', $params);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $user = new User();
        $user->name             = $request->name;
        $user->gender           = $request->gender;
        $user->day_of_birth     = $request->day_of_birth;
        $user->address          = $request->address;
        $user->email            = $request->email;
        $user->phone            = $request->phone;
        $user->password         = Hash::make($request->password);
        $user->start_day        = $request->start_day;
        $user->user_group_id    = $request->user_group_id;
        $user->note    = $request->note;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $storedPath = $avatar->move('avatars', $avatar->getClientOriginalName());
            $user->avatar           = 'avatars/' . $avatar->getClientOriginalName();
        }

        // dd($user);

        try {
            $user->save();
            return redirect()->route('users.index')->with('success', 'Thêm' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('success', 'Thêm' . ' ' . $request->name . ' ' .  'không thành công');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user =  User::find($id);
        $this->authorize('update', $user);
        $userGroups = UserGroup::all();
        $params = [
            'user' => $user,
            'userGroups' => $userGroups,
        ];
        return view('admin.users.edit', $params);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name             = $request->name;
        $user->gender           = $request->gender;
        $user->day_of_birth     = $request->day_of_birth;
        $user->address          = $request->address;
        $user->email            = $request->email;
        $user->phone            = $request->phone;
        $user->note    = $request->note;
        if ($request->password) {
            $user->password         = Hash::make($request->password);
        }
        $user->start_day        = $request->start_day;
        $user->user_group_id    = $request->user_group_id;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $storedPath = $avatar->move('avatars', $avatar->getClientOriginalName());
            $user->avatar           = 'avatars/' . $avatar->getClientOriginalName();
        }

// dd($user);
        try {
            $user->save();
            return redirect()->route('users.index')->with('success', 'Sửa' . ' ' . $request->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('success', 'Sửa' . ' ' . $request->name . ' ' .  'không thành công');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->authorize('delete', $user);
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Xóa  thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.index')->with('success', 'Xóa không  thành công');
        }
    }

    public function trashedItems(Request $request)
    {
        $query = User::onlyTrashed();
        //sắp xếp thứ tự lên trước khi update
        $query->orderBy('id', 'desc');
        $users = $query->paginate(20);
        // dd($users);
        $userGroups = UserGroup::all();

        $params = [
            'users' => $users,
            'userGroups' =>  $userGroups,
            'filter' => $request->filter,
            'user_role' => 'trash'
        ];
        return view('admin.users.trash', $params);
    }

    public function force_destroy($id)
    {

        $user = User::withTrashed()->find($id);
        // dd($user);
        $this->authorize('forceDelete', $user);
        try {
            $user->forceDelete();
            return redirect()->route('users.trash')->with('success', 'Xóa' . ' ' . $user->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.trash')->with('error', 'Xóa' . ' ' . $user->name . ' ' .  'không thành công');
        }
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $this->authorize('restore', $user);
        try {
            $user->restore();
            return redirect()->route('users.trash')->with('success', 'Khôi phục' . ' ' . $user->name . ' ' .  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('users.trash')->with('error', 'Khôi phục' . ' ' . $user->name . ' ' .  'không thành công');
        }
    }
    // public function import()
    // {
    //     $userGroups = UserGroup::all();
    //     $params = [
    //         'userGroups' => $userGroups,
    //     ];
    //     return view('admin.users.import', $params);
    // }

    // public function postImport(PostImportRequest $request){
    //     $path = $request->file('file')->getRealPath();

    //     FacadesExcel::import(new UsersImport($request), $path);
    //     return redirect()->route('users.index')->with('success', 'Thêm nhân viên thành công');
    // }

}
