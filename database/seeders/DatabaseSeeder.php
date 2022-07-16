<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Insurance;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->importRoles();
        $this->importUserGroups();
        $this->importUser();
        $this->importUserGroupRoles();
        // $this->importInsurances();
    }

    public function importUserGroups()
    {
        $userGroup = new UserGroup();
        $userGroup->name = 'Quản Lý';
        $userGroup->save();

        $userGroup = new UserGroup();
        $userGroup->name = 'Nhân Viên';
        $userGroup->save();
    }
    public function importRoles()
    {
        $groups     = ['Insurance', 'User', 'UserGroup', 'Role'];
        $actions    = ['viewAny', 'view', 'create', 'update', 'delete', 'restore', 'forceDelete'];
        foreach ($groups as $group) {
            foreach ($actions as $action) {
                DB::table('roles')->insert([
                    'name' => $group . '_' . $action,
                    'group_name' => $group,
                ]);
            }
        }
    }
    public function importUser()
    {
        $user = new User();
        $user->name = 'Huỳnh Văn Toàn';
        $user->email = 'toan@gmail.com';
        $user->password = Hash::make('123456');
        $user->day_of_birth = '2002/09/24';
        $user->phone = '0935779035';
        $user->address = 'Quảng Trị';
        $user->start_day = '2022/01/10';
        $user->user_group_id  = '2';
        $user->gender = 'Nam';
        $user->avatar = 'upload/admin14.png';
        $user->save();

        $user = new User();
        $user->name = 'Võ Văn Tuấn';
        $user->email = 'tuan@gmail.com';
        $user->password = Hash::make('123456');
        $user->day_of_birth = '2002/04/24';
        $user->phone = '0777333274';
        $user->address = 'Quảng Trị';
        $user->start_day = '2021/10/29';
        $user->user_group_id  = '1';
        $user->gender = 'Nam';
        $user->avatar = 'upload/admin13.png';
        $user->save();

        $user = new User();
        $user->name = 'Mai Chiếm An';
        $user->email = 'an@gmail.com';
        $user->password = Hash::make('123456');
        $user->day_of_birth = '2003/06/27';
        $user->phone = '0916663237';
        $user->address = 'Quảng Trị';
        $user->start_day = '2021/10/29';
        $user->user_group_id  = '2';
        $user->gender = 'Nam';
        $user->avatar = 'upload/admin10.png';
        $user->save();

        $user = new User();
        $user->name = 'Nguyễn Văn Quốc Việt';
        $user->email = 'viet@gmail.com';
        $user->password = Hash::make('123456');
        $user->day_of_birth = '2001/03/21';
        $user->phone = '0123456789';
        $user->address = 'Quảng Trị';
        $user->start_day = '2022/02/12';
        $user->user_group_id  = '2';
        $user->gender = 'Nam';
        $user->avatar = 'upload/admin22.png';
        $user->save();

        $user = new User();
        $user->name = 'Trần Ngọc Linh';
        $user->email = 'Linh@gmail.com';
        $user->password = Hash::make('123456');
        $user->day_of_birth = '2003/11/11';
        $user->phone = '0123456788';
        $user->address = 'Quảng Trị';
        $user->start_day = '2022/02/12';
        $user->user_group_id  = '2';
        $user->gender = 'Nam';
        $user->avatar = 'upload/admin21.png';
        $user->save();
    }

    public function importUserGroupRoles()
    {
        for ($i = 1; $i <= 28; $i++) {
            DB::table('user_group_roles')->insert([
                'user_group_id' => 1,
                'role_id' => $i,
            ]);
        }
    }

    // public function importInsurances()
    // {
    //     $insurances = [

    //     ];

    //     $fields = [
    //         'contract' => 84556999922,
    //         'name' => 'Võ Văn Tuấn',
    //         'phone' => 842525959558,
    //         'description' => 'Để thực hiện chức năng tra cứu mã số bảo hiểm xã hội, xin vui lòng nhập đầy đủ các thông tin cần thiết.',
    //         'total' => 995256,
    //         'email' =>  'toan@gmail.com',
    //         'unit' => 'VND',
    //         'paid_and_unpaid_amount' => array_rand(array_flip(['Paid', 'Amount_unpaid'])),
    //         'contract_package' => array_rand(array_flip(['Term_life_insurance', 'Term_life_insurance', 'Mixed_insurance', 'Periodic_payment_insurance', 'Lifetime_insurance'])),
    //         'linkYoutube' => 'https://file4.batdongsan.com.vn/resize/745x510/2022/04/17/20220417200500-9939_wm.jpeg',
    //         'insurance_start_date' => date('Y-m-d'),
    //         'insurance_open_date_Paid' => date('Y-m-d'),
    //         'insurance_open_date_Paid' => date('Y-m-d'),
    //         'insurance_start_date_payment' => date('Y-m-d', strtotime('+10 days')),
    //         'insurance_images' => [
    //             'https://file4.batdongsan.com.vn/resize/745x510/2022/04/17/20220417200500-9939_wm.jpeg',
    //             'https://file4.batdongsan.com.vn/2022/04/05/20220405105613-203d_wm.jpg',
    //         ],
    //     ];

    //     $insurance_images = [];
    //     foreach ($insurances as $insurance) {
    //         $objInsurance = new Insurance();
    //         $objInsurance->contract = $insurance;
    //         foreach ($fields as $field => $value) {
    //             if ($field != 'insurance_images') {
    //                 $objInsurance->$field = $value;
    //             }
    //         }
    //         $objInsurance->save();
    //         $insurance_images = $fields['insurance_images'];
    //         foreach ($insurance_images as $insurance_image) {
    //             $objInsuranceImage = new Image();
    //             $objInsuranceImage->insurance_id = $objInsurance->id;
    //             $objInsuranceImage->photo_CMND_photo_contract = $insurance_image;
    //             $objInsuranceImage->save();
    //         }
    //     }
    // }
}
