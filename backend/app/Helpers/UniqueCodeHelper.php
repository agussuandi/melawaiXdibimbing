<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

use App\Models\MCustomers;
use App\Models\MMaterials;
use App\Models\MCustomerReceipts;

class UniqueCodeHelper
{
    public static function generateCustomerCode()
    {
        $lastCustomer = MCustomers::selectRaw('MAX(SUBSTRING(code, 3, 8)) as customer_code')->first();

        if($lastCustomer->customer_code) $increment = (int)$lastCustomer->customer_code + 1;
        else $increment = 1;

        return 'CM' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateReceiptCode()
    {
        $lastReceipt = MCustomerReceipts::selectRaw('MAX(SUBSTRING(code, 3, 8)) as receipt_code')->first();

        if($lastReceipt->receipt_code) $increment = (int)$lastReceipt->receipt_code + 1;
        else $increment = 1;

        return 'CR' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateMaterialCode()
    {
        $lastReceipt = MMaterials::selectRaw('MAX(SUBSTRING(code, 3, 8)) as material_code')->first();

        if($lastReceipt->material_code) $increment = (int)$lastReceipt->material_code + 1;
        else $increment = 1;

        return 'M' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }

    public static function generateSalesOrderCode()
    {
        $lastReceipt = MCustomerReceipts::selectRaw('MAX(SUBSTRING(code, 3, 8)) as receipt_code')->first();

        if($lastReceipt->receipt_code) $increment = (int)$lastReceipt->receipt_code + 1;
        else $increment = 1;

        return 'CSO' . str_pad($increment, 8, 0, STR_PAD_LEFT);
    }
}