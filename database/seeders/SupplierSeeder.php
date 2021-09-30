<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'company_name'=> 'SwafTech', 'contact_name'=> 'Ahmad', 'city'=> 'Damascus', 'country'=>'Syria', 'phone'=>'33324587', 'fax'=>'33324588'],
            ['id' => 2, 'company_name'=> 'Durra', 'contact_name'=> 'سعيد', 'city'=> 'دمشق', 'country'=>'سوريا', 'phone'=> '0113855454','fax'=> null],
            ['id' => 3, 'company_name'=> 'كهربائيات المصري', 'contact_name'=> 'محمود', 'city'=> 'حلب', 'country'=>'سوريا', 'phone'=>null, 'fax'=>null],
        ];
        Supplier::insert($data);    
    }
}
