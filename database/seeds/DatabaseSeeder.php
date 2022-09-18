<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('supplier_typies')->insert([
            [
                'name' => 'Main Supplier',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Main Supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Reseller',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Reseller like local supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('customer_typies')->insert([
            [
                'name' => 'Permanent Customer',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Main Supplier',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Walking / Temporary Customer',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Walking / Temporary Customer',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('discount_typies')->insert([
            [
                'name' => 'Fixed',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Fixed',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Percentage',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Percentage',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('commissions_typies')->insert([
            [
                'name' => 'Fixed',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Fixed',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Percentage',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Percentage',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('liability_typies')->insert([
            [
                'name' => 'Warranty',
                'description' => 'Warranty',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Guarantee',
                'description' => 'Guarantee',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('prices')->insert([
            [
                'name' => 'mrp_price',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'label' => 'MRP Price',
                'description' => 'MRP Price',
                'created_by' => 1,
                'custom_serial' => 5,
                'use_in'    =>1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'sell_price',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'label' => 'Retail Price',
                'description' => 'Retail Sell Price',
                'custom_serial' => 4,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'whole_sell_price',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'label' => 'Whole Sell Price',
                'description' => 'Whole Sell Price',
                'custom_serial' => 3,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'offer_price',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'label' => 'Offer Price',
                'description' => 'Offer Sell Price',
                'custom_serial' => 1,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'purchase_price',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'label' => 'Purchase Price',
                'description' => 'Purchase Price',
                'custom_serial' => 2,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('stocks')->insert([
            [
                'name' => 'regular_stock',
                'label' => 'Regular Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'use_in'    =>1,
                'description' => 'Regular Stock',
                'custom_serial' => 1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'low_stock',
                'label' => 'Low Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'use_in'    =>1,
                'description' => 'Low Stock',
                'custom_serial' => 2,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'high_stock',
                'label' => 'High Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'description' => 'High Stock',
                'custom_serial' => 3,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'offer_stock',
                'label' => 'Offer Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'description' => 'Offer Stock',
                'custom_serial' => 4,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'reseller_stock',
                'label' => 'Reseller Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'description' => 'Reseller Stock',
                'custom_serial' => 5,
                'use_in'    =>1,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'damage_stock',
                'label' => 'Damage Stock',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'status'    =>1,
                'description' => 'Damage Stock',
                'custom_serial' => 6,
                'use_in'    =>0,
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('units')->insert([
            [
                'full_name' => 'Piece',
                'short_name' => 'Piece',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 1,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Piece',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'full_name' => 'Inch',
                'short_name' => 'Inch',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 2,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Inch',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Fit',
                'short_name' => 'Fit',
                'parent_id' => 2,
                'parent_cal_result' => 1.000,
                'calculation_value' => 12.000,
                'calculation_result' =>  12.000,
                'base_unit_id' => 2,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Fit',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Liter',
                'short_name' => 'Liter',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 4,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Liter',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Gram',
                'short_name' => 'gm',
                'parent_id' => 0,
                'parent_cal_result' => NULL,
                'calculation_value' => 1.000,
                'calculation_result' =>  1.000,
                'base_unit_id' => 5,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Gram',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'full_name' => 'Kilogram',
                'short_name' => 'kg',
                'parent_id' => 5,
                'parent_cal_result' => 1.000,
                'calculation_value' => 1000.000,
                'calculation_result' =>  1000.000,
                'base_unit_id' => 5,
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Kilogram',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        DB::table('stock_changing_typies')->insert([
            [
                'name' => 'initial_stock_type_increment',
                'label' => 'product inserted time - initialStockTypeIncrement',
                'changing_sign' => '+',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'When product inserted, initial stock added here',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'selling_from_poss_stock_type_decrement',
                'label' => 'sellingFromPossStockTypeDecrement',
                'changing_sign' => '-',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'When sell product from poss',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'selling_return_stock_type_increment',
                'label' => 'sellingReturnStockTypeIncrement',
                'changing_sign' => '+',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when sell return regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'purchase_regular_stock_type_increment',
                'label' => 'purchaseRegularStockTypeIncrement',
                'changing_sign' => '+',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when purchase regular :-its regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'purchase_return_stock_decrement',
                'label' => 'purchaseReturnStockTypeDecrement',
                'changing_sign' => '-',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when purchase return :- regular process',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'transfer_from_stock_type_decrement',
                'label' => 'transferFromStockTypeDecrement',
                'changing_sign' => '-',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when transfer from stock',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'transfer_to_stock_type_increment',
                'label' => 'transferToStockTypeIncrement',
                'changing_sign' => '+',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when received transfered stock ',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'damage_stock_type_decrement',
                'label' => 'damageStockTypeDecrement :When product damage',
                'changing_sign' => '-',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Stock Decrease/Reduce :When product damage',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'adjustment_stock_type_increment',
                'label' => 'adjustmentStockTypeIncrement',
                'changing_sign' => '+',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'when adjustment stock ',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],[
                'name' => 'adjustment_stock_type_decrement',
                'label' => 'adjustmentStockTypeDecrement :When product adjustment',
                'changing_sign' => '-',
                'branch_id' => 1,//Auth::guard('web')->user()->id,
                'description' => 'Stock Decrease/Reduce :When product adjustment',
                'created_by' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

    }


}
