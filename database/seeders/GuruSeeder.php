<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nip' => '196504121990031002', 'nama' => 'Budi Santoso S.Pd', 'email' => 'budi.santoso@smk.ac.id', 'no_telp' => '081234567890', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1965-04-12', 'username_user' => '196504121990031002', 'kode' => 'MTK'],
            ['nip' => '198107252005012003', 'nama' => 'Siti Rahayu S.Pd', 'email' => 'siti.rahayu@smk.ac.id', 'no_telp' => '081345678901', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1981-07-25', 'username_user' => '198107252005012003', 'kode' => 'BIN'],
            ['nip' => '199001152010012005', 'nama' => 'H. Dewi Lestari, S.Pd', 'email' => 'dewi.lestari@smk.ac.id', 'no_telp' => '081456789012', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1990-01-15', 'username_user' => '199001152010012005', 'kode' => 'BIG'],
            ['nip' => '199208172015031001', 'nama' => 'Drs. Ahmad Hidayat S.T', 'email' => 'ahmad.hidayat@smk.ac.id', 'no_telp' => '081567890123', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1992-08-17', 'username_user' => '199208172015031001', 'kode' => 'PWEB'],
            ['nip' => '199503062018011001', 'nama' => 'Rina Fitriani, S.Kom', 'email' => 'rina.fitriani@smk.ac.id', 'no_telp' => '081678901234', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1995-03-06', 'username_user' => '199503062018011001', 'kode' => 'BADA'],
            ['nip' => '196811221990091009', 'nama' => 'H. Syamsul Arifin, S.Ag', 'email' => 'syamsul.arifin@smk.ac.id', 'no_telp' => '081234567898', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1968-11-22', 'username_user' => '196811221990091009', 'kode' => 'PAI'],
            ['nip' => '197609111996071007', 'nama' => 'Hj. Nurhayati, S.Pd, M.Pd', 'email' => 'nurhayati@smk.ac.id', 'no_telp' => '081234567899', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1976-09-11', 'username_user' => '197609111996071007', 'kode' => 'PKN'],
            ['nip' => '197203051995012003', 'nama' => 'Siti Marlia S.Pd', 'email' => 'siti.marlia@smk.ac.id', 'no_telp' => '081234567891', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1972-03-05', 'username_user' => '197203051995012003', 'kode' => 'MTK'],
            ['nip' => '198108101998022004', 'nama' => 'Andri Gunawan M.Kom', 'email' => 'andri.gunawan@smk.ac.id', 'no_telp' => '081234567892', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1981-08-10', 'username_user' => '198108101998022004', 'kode' => 'BIN'],
            ['nip' => '198511221999032005', 'nama' => 'Dewi Kartika S.T., M.T', 'email' => 'dewi.kartika@smk.ac.id', 'no_telp' => '081234567893', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1985-11-22', 'username_user' => '198511221999032005', 'kode' => 'BIG'],
            ['nip' => '197911011996042006', 'nama' => 'Ahmad Fauzi S.Pd., M.Pd', 'email' => 'ahmad.fauzi@smk.ac.id', 'no_telp' => '081234567894', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1979-11-01', 'username_user' => '197911011996042006', 'kode' => 'PWEB'],
            ['nip' => '198910151997052007', 'nama' => 'Lilis Nuraini S.Kom', 'email' => 'lilis.nuraini@smk.ac.id', 'no_telp' => '081234567895', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1989-10-15', 'username_user' => '198910151997052007', 'kode' => 'BADA'],
            ['nip' => '197706301994062008', 'nama' => 'Hendra Suhendra M.Si', 'email' => 'hendra.suhendra@smk.ac.id', 'no_telp' => '081234567896', 'jenis_kelamin' => 'L', 'tgl_lahir' => '1977-06-30', 'username_user' => '197706301994062008', 'kode' => 'PAI'],
            ['nip' => '198003101995072009', 'nama' => 'Ratna Dewi S.Pd', 'email' => 'ratna.dewi@smk.ac.id', 'no_telp' => '081234567897', 'jenis_kelamin' => 'P', 'tgl_lahir' => '1980-03-10', 'username_user' => '198003101995072009', 'kode' => 'PKN'],
        ];

        foreach ($data as $guru) {
            Guru::updateOrCreate(
                ['nip' => $guru['nip']],
                $guru
            );
        }
    }
}