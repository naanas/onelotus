<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Perawatan;

class PasienExport implements FromQuery, WithHeadings
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    function __construct($date)
    {
        $this->year = $date[0];
        $this->month = $date[1];
    }
    public function query()
    {
        return Perawatan::query()->join('data_pasiens', 'data_pasiens.id', '=', 'perawatan.data_pasien_id')
            ->whereYear('perawatan.created_at', $this->year)
            ->whereMonth('perawatan.created_at', $this->month)
            ->select('data_pasiens.nama', 'data_pasiens.nomor', 'ttl', 'tlp', 'alamat', 'bb', 'tb', 'gender', 'instansi', 'hobi', 'perawatan.keluhan', 'analisa', 'treatment', 'bagian_penenang', 'kesimpulan', 'terapis', 'perawatan.created_at');
    }
    public function headings(): array
    {
        return ['Nama', 'Nomor Pasien', 'Tanggal_Lahir', 'Nomor_Telepon', 'Alamat', 'bb', 'tb', 'Jenis_Kelamin', 'Instansi', 'Hobi/Kegiatan', 'Keluhan', 'Analisa', 'Treatment', 'Bagian_Penanganan', 'Kesimpulan', 'Terapis', 'Tanggal'];
    }
}
