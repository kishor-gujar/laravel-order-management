<?php
namespace App\Exports;

use App\Order;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection , WithHeadings
{

    /**
     * @return Collection
     */
    public function collection()
    {
        return Order::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [

            'Id',
            'Name',
            'Phone',
            'Address',
            'City',
            'Town',
            'Quantity',
            'Price',
            'Product',
//        'status',
            'Specific',
            'Date',
            'Note',
            'status_id',
            ];
    }
}