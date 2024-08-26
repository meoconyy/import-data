<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;

class ProductsImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        $data = [];

        foreach ($rows as $row) {
            $data[] = [
                'short_name' => $row['ten_tat'],
                'name' => $row['ten_hang'],
                'product_id' => $row['id'],
                'unit_1' => $row['dv_tinh1'],
                'unit_2' => $row['dv_tinh_2'],
                'factor_1' => $row['he_so_1'],
                'unit_3' => $row['dv_tinh_3'],
                'factor_2' => $row['he_so_2'],
                'purchase_price' => $row['gia_nhap'],
                'sale_price' => $row['gia_ban'],
                'declared_price' => $row['gia_ke_khai'],
                'cost_goods_sold' => $row['gia_nhap_gia_von'],
                'list_price' => $row['gia_niem_yet'],
                'specific_cost' => $row['gia_von_dich_danh'],
                'hapu_price' => $row['gia_hapu'],
                'hapu_price_update_date' => \Carbon\Carbon::create(1900, 1, 1)->addDays($row['ngay_cap_nhat_gia_hapu'] - 2)->format('Y-m-d'),
                'min_sale_price' => $row['gia_ban_toi_thieu'],
                'max_sale_price' => $row['gia_ban_toi_da'],
                'quality_registration_number' => $row['so_dkcl'],
                'specification' => $row['quy_cach'],
                'storage_code' => $row['ma_noi_de'],
                'storage_location' => $row['noi_de'],
                'position' => $row['vi_tri'],
                'product_type' => $row['loai_hang'],
                'classification' => $row['phan_loai'],
                'product_group' => $row['nhom_hang'],
            ];
        }

        foreach (array_chunk($data, 1000) as $chunk) {
            try {
                Product::insert($chunk);
            } catch (\Exception $e) {
                // Xử lý lỗi
                Log::error("Insert failed: " . $e->getMessage());
            }
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
