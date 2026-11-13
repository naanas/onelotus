<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models \ {
    DataPasien,
    Perawatan,
    DataForm
};
use App\Exports\PasienExport;
use Excel;
use function PHPUnit\Framework\isEmpty;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\DB;

class DataPasienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('pasien.data-perbulan');
    }
    public function tambah()
    {
        return view('pasien.tambah');
    }
    public function save(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'ttl' => ['required'],
            'tlp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'gender' => ['required'],
            'instansi' => ['required'],
            'bb' => ['numeric'],
            'tb' => ['numeric'],
        ]);

        //$nomor = DB::table('data_pasiens')->select('nomor')->latest('nomor')->first();
        if ($request['nomor']) {
            $no = $request['nomor'];
        } else {
            $nomor = DB::table('data_pasiens')->max('nomor');
            $no = $nomor + 1;
        }

        if (DataPasien::where('nomor', '=', $no)->exists()) {
            $massage = "Nomor Pasien $no sudah ada.";
            session()->flash('error', $massage);
            return back()->withInput();
        }

        $data = new DataPasien(
            [
                'nama' => $request['nama'],
                'ttl' => $request['ttl'],
                'tlp' => $request['tlp'],
                'alamat' => $request['alamat'],
                'gender' => $request['gender'],
                'instansi' => $request['instansi'],
                'nomor' => $no,
                'hobi' => $request['hobi'],
                'tb' => $request['tb'],
                'bb' => $request['bb'],
            ]
        );
        $data->save();
        $route = 'detail-pasien/' . $data->id . '/tambah-pemeriksaan';

        session()->flash('success', 'Data pasien berhasil dibuat.');
        return redirect($route);
    }
    public function deletePasien($id)
    {
        $pasien = DataPasien::find($id);
        $pasien->delete();

        session()->flash('success', 'Data pasien berhasil dihapus.');

        return redirect()->back();
    }
    public function editPasien($id)
    {
        $pasien = DataPasien::find($id);


        return view('pasien.edit', ['pasien' => $pasien]);
    }
    public function saveEditPasien(Request $request)
    {
        $this->validate($request, [
            'nama' => ['required'],
            'ttl' => ['required'],
            'tlp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'gender' => ['required'],
            'instansi' => ['required'],
            'nomor' => ['required', 'numeric'],
            'bb' => ['numeric'],
            'tb' => ['numeric'],

        ]);
        $no = $request['nomor'];

        if (DataPasien::where('nomor', '=', $no)->exists()) {
            $massage = "Nomor Pasien $no sudah ada.";
            session()->flash('error', $massage);
            return back()->withInput();
        }
        DataPasien::find($request->id)->update([
            'nama' => $request->nama,
            'ttl' => $request->ttl,
            'tlp' => $request->tlp,
            'alamat' => $request->alamat,
            'gender' => $request->gender,
            'instansi' => $request->instansi,
            'nomor' => $request->nomor,
            'hobi' => $request['hobi'],
            'tb' => $request['tb'],
            'bb' => $request['bb'],
        ]);
        $route = 'detail-pasien/' . $request->id;
        session()->flash('success', 'Data pasien berhasil diedit.');

        return redirect($route);
    }
    public function detail($id)
    {
        $pasien = DataPasien::find($id);

        return view('pasien.detail', ['pasien' => $pasien]);
    }
    public function deletePemeriksaan(Perawatan $perawatan)
    {
        $perawatan->delete();

        session()->flash('success', 'Data pemeriksaan pasien berhasil dihapus.');

        return redirect()->back();
    }
    public function tambahPemeriksaan($id)
    {
        $pasien = DataPasien::find($id);
        return view('pasien.tambah-pemeriksaan', [
            'id' => $id,
            'pasien' => $pasien
        ]);
    }
    public function savePemeriksaan(Request $request)
    {
        $id = $request['data_pasien_id'];
        $perawatan = new Perawatan(
            [
                'data_pasien_id' => $id,
                'keluhan' => $request['keluhan'],
                'analisa' => $request['analisa'],
                'treatment' => $request['treatment'],
                'bagian_penenang' => $request['bagian_penenang'],
                'kesimpulan' => $request['kesimpulan'],
                'terapis' => $request['terapis'],
                'penyebab' => $request['penyebab'],
                'lama_cedera' => $request['lama'],
                'hasil_rontgen' => $request['rontgen'],
            ]
        );

        if ($request->tgl_periksa != null) {
            $perawatan->created_at = $request->tgl_periksa;
        }
        $perawatan->save();
        $route = 'detail-pasien/' . $id;
        session()->flash('success', 'Data pemeriksaan pasien berhasil ditambah.');

        return redirect($route);
    }
    public function editPemeriksaan($id)
    {
        $data = Perawatan::find($id);

        return view('pasien.edit-pemeriksaan', ['data' => $data]);
    }
    public function updatePemeriksaan(Request $request)
    {
        $pemeriksaan = Perawatan::find($request->id);
        $pemeriksaan->update([
            'keluhan' => $request['keluhan'],
            'analisa' => $request['analisa'],
            'treatment' => $request['treatment'],
            'bagian_penenang' => $request['bagian_penenang'],
            'kesimpulan' => $request['kesimpulan'],
            'terapis' => $request['terapis'],
            'penyebab' => $request['penyebab'],
            'lama' => $request['lama'],
        ]);


        $route = 'detail-pasien/' . $pemeriksaan->data_pasien->id;
        session()->flash('success', 'Data pemeriksaan pasien berhasil diedit.');

        return redirect($route);
    }
    public function export()
    {
        return view('pasien.export');
    }
    public function export_query(Request $request)
    {
        $date = explode('-', $request->bulan);
        $data = Perawatan::whereYear('created_at', $date[0])->whereMonth('created_at', $date[1])->get();

        if ($data->isEmpty()) {
            session()->flash('error', 'Tidak ada data pemeriksaan pasien pada bulan ' . $date[1] . ' tahun ' . $date[0]);
            return back();
        } else {
            $name = $date[1] . '-' . $date[0] . '_data_pasien.xlsx';
            return Excel::download(new PasienExport($date), $name);
        }
    }

    public function showPasien(Request $request)
    {

        if ($request->limit == null) {
            return view('pasien.limit-pasien');
        } else {
            $date = explode('-', $request->limit);
            $data = Perawatan::query()->join('data_pasiens', 'data_pasiens.id', '=', 'perawatan.data_pasien_id')
                ->whereYear('perawatan.created_at', $date[0])
                ->whereMonth('perawatan.created_at', $date[1])
                ->select('data_pasiens.nomor as id', 'data_pasiens.nama as nama', 'gender', 'ttl', 'alamat', 'perawatan.keluhan as keluhan', 'analisa', 'treatment', 'bagian_penenang', 'perawatan.created_at')->get();
            //whereYear('created_at', $date[0])->whereMonth('created_at', $date[1])->orderBy('created_at', 'desc')->get();
            return view('pasien.limit-pasien', [
                'pasien' => $data,
                'date' => $date
            ]);
        }
    }
    public function saveForm(Request $request)
    {
        $nomor = DB::table('data_pasiens')->max('nomor');
        $no = $nomor + 1;
        $date = str_replace('/', '-', $request['Tanggal_Lahir']);
        $tgl_lahir = date("Y-m-d", strtotime($date));

        if (is_int($request['Tinggi_Badan'])) {
            $tb = $request['Tinggi_Badan'];
        } else {
            $tb = null;
        }

        if (is_int($request['Berat_Badan'])) {
            $bb = $request['Berat_Badan'];
        } else {
            $bb = null;
        }


        if (DataPasien::where('nomor', '=', $no)->exists()) {
            $massage = "Nomor Pasien $no sudah ada.";
            session()->flash('error', $massage);
            return back()->withInput();
        }

        $data = new DataPasien(
            [
                'nama' => $request['Nama'],
                'ttl' => $tgl_lahir,
                'tlp' => $request['Nomor_Telepon'],
                'alamat' => $request['Alamat'],
                'gender' => $request['Jenis_Kelamin'],
                'instansi' => $request['Instansi'],
                'nomor' => $no,
                'hobi' => $request['Hobi/Kegiatan'],
                'tb' => $tb,
                'bb' => $bb,
                'tempat_lahir' => $request['Tempat_Lahir'],
            ]
        );
        $data->save();

        $timestamp = $request['Timestamp'];
        $data_form = new DataForm(
            [
                'timestamp' => $timestamp,
                'data_pasien_id' => $data->id,

            ]
        );
        $data_form->save();

        $route = 'detail-pasien/' . $data->id . '/tambah-pemeriksaan';

        session()->flash('success', 'Data pasien berhasil dibuat.');
        return redirect($route)->with([
            'keluhan' => $request['Keluhan/Cedera'],
            'penyebab' => $request['Penyebab_Cedera'],
            'lama' => $request['Lama_Cedera'],
            'rontgen' => $request['Rontgen'],
        ]);
    }
    public function showForm()
    {
        $form = DataForm::join('data_pasiens', 'data_pasiens.id', '=', 'forms.data_pasien_id')->select('nama', 'timestamp')->get();
        return view('forms.result-form', ['form' => $form]);
    }
}
