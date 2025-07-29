<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Murid;

class MuridSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nis' => '1001', 'nama' => 'Andi Saputra', 'kelas' => 'XI RPL 1', 'no_telp' => '089876543210', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-03-15', 'username_user' => '1001'],
            ['nis' => '1002', 'nama' => 'Budi Prakoso', 'kelas' => 'XI RPL 1', 'no_telp' => '089765432109', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-06-22', 'username_user' => '1002'],
            ['nis' => '1003', 'nama' => 'Cindy Amelia', 'kelas' => 'XI RPL 1', 'no_telp' => '089654321098', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-08-19', 'username_user' => '1003'],
            ['nis' => '1004', 'nama' => 'Deni Ramadhan', 'kelas' => 'XI RPL 1', 'no_telp' => '089543210987', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-12-01', 'username_user' => '1004'],
            ['nis' => '1005', 'nama' => 'Eka Putri', 'kelas' => 'XI RPL 1', 'no_telp' => '089432109876', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-09-10', 'username_user' => '1005'],
            ['nis' => '1006', 'nama' => 'Farhan Maulana', 'kelas' => 'XI RPL 1', 'no_telp' => '089321098765', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-01-25', 'username_user' => '1006'],
            ['nis' => '1007', 'nama' => 'Gina Rahmawati', 'kelas' => 'XI RPL 1', 'no_telp' => '089210987654', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-04-17', 'username_user' => '1007'],
            ['nis' => '1008', 'nama' => 'Hendra Saputra', 'kelas' => 'XI RPL 1', 'no_telp' => '089109876543', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-05-06', 'username_user' => '1008'],
            ['nis' => '1009', 'nama' => 'Indah Permata', 'kelas' => 'XI RPL 1', 'no_telp' => '089098765432', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-11-29', 'username_user' => '1009'],
            ['nis' => '1010', 'nama' => 'Joko Santoso', 'kelas' => 'XI RPL 1', 'no_telp' => '088987654321', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-07-13', 'username_user' => '1010'],
            ['nis' => '1011', 'nama' => 'Kevin Aditya', 'kelas' => 'XI RPL 1', 'no_telp' => '088876543210', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-10-01', 'username_user' => '1011'],
            ['nis' => '1012', 'nama' => 'Lilis Nuraini', 'kelas' => 'XI RPL 1', 'no_telp' => '088765432109', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-02-05', 'username_user' => '1012'],
            ['nis' => '1013', 'nama' => 'Miftah Huda', 'kelas' => 'XI RPL 1', 'no_telp' => '088654321098', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-12-30', 'username_user' => '1013'],
            ['nis' => '1014', 'nama' => 'Nia Lestari', 'kelas' => 'XI RPL 1', 'no_telp' => '088543210987', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-03-23', 'username_user' => '1014'],
            ['nis' => '1015', 'nama' => 'Oki Pratama', 'kelas' => 'XI RPL 1', 'no_telp' => '088432109876', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-06-12', 'username_user' => '1015'],
            ['nis' => '1016', 'nama' => 'Putri Ayu', 'kelas' => 'XI RPL 2', 'no_telp' => '088321098765', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-08-28', 'username_user' => '1016'],
            ['nis' => '1017', 'nama' => 'Qory Amalia', 'kelas' => 'XI RPL 2', 'no_telp' => '088210987654', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-09-14', 'username_user' => '1017'],
            ['nis' => '1018', 'nama' => 'Rian Kurniawan', 'kelas' => 'XI RPL 2', 'no_telp' => '088109876543', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-07-07', 'username_user' => '1018'],
            ['nis' => '1019', 'nama' => 'Sinta Wulandari', 'kelas' => 'XI RPL 2', 'no_telp' => '088098765432', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-01-03', 'username_user' => '1019'],
            ['nis' => '1020', 'nama' => 'Tegar Wahyudi', 'kelas' => 'XI RPL 2', 'no_telp' => '087987654321', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-02-27', 'username_user' => '1020'],
            ['nis' => '1021', 'nama' => 'Ulya Fitriana', 'kelas' => 'XI RPL 2', 'no_telp' => '087876543210', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-05-16', 'username_user' => '1021'],
            ['nis' => '1022', 'nama' => 'Vina Zahra', 'kelas' => 'XI RPL 2', 'no_telp' => '087765432109', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-03-05', 'username_user' => '1022'],
            ['nis' => '1023', 'nama' => 'Wahyu Hidayat', 'kelas' => 'XI RPL 2', 'no_telp' => '087654321098', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-10-20', 'username_user' => '1023'],
            ['nis' => '1024', 'nama' => 'Xena Azzahra', 'kelas' => 'XI RPL 2', 'no_telp' => '087543210987', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-06-30', 'username_user' => '1024'],
            ['nis' => '1025', 'nama' => 'Yoga Pratama', 'kelas' => 'XI RPL 2', 'no_telp' => '087432109876', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-04-22', 'username_user' => '1025'],
            ['nis' => '1026', 'nama' => 'Zahra Kusuma', 'kelas' => 'XI RPL 2', 'no_telp' => '087321098765', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-09-25', 'username_user' => '1026'],
            ['nis' => '1027', 'nama' => 'Aldi Fernando', 'kelas' => 'XI RPL 2', 'no_telp' => '087210987654', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-05-31', 'username_user' => '1027'],
            ['nis' => '1028', 'nama' => 'Bella Anjani', 'kelas' => 'XI RPL 2', 'no_telp' => '087109876543', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-07-18', 'username_user' => '1028'],
            ['nis' => '1029', 'nama' => 'Candra Setiawan', 'kelas' => 'XI RPL 2', 'no_telp' => '087098765432', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-08-03', 'username_user' => '1029'],
            ['nis' => '1030', 'nama' => 'Dita Marlina', 'kelas' => 'XI RPL 2', 'no_telp' => '086987654321', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-10-11', 'username_user' => '1030'],
            ['nis' => '1031', 'nama' => 'Evan Yulianto', 'kelas' => 'XI RPL 3', 'no_telp' => '086876543210', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-01-20', 'username_user' => '1031'],
            ['nis' => '1032', 'nama' => 'Fira Nurhaliza', 'kelas' => 'XI RPL 3', 'no_telp' => '086765432109', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-04-08', 'username_user' => '1032'],
            ['nis' => '1033', 'nama' => 'Galih Permadi', 'kelas' => 'XI RPL 3', 'no_telp' => '086654321098', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-06-02', 'username_user' => '1033'],
            ['nis' => '1034', 'nama' => 'Hilda Rosanti', 'kelas' => 'XI RPL 3', 'no_telp' => '086543210987', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-07-24', 'username_user' => '1034'],
            ['nis' => '1035', 'nama' => 'Irfan Maulana', 'kelas' => 'XI RPL 3', 'no_telp' => '086432109876', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-03-12', 'username_user' => '1035'],
            ['nis' => '1036', 'nama' => 'Jessica Andini', 'kelas' => 'XI RPL 3', 'no_telp' => '086321098765', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-08-07', 'username_user' => '1036'],
            ['nis' => '1037', 'nama' => 'Kiki Susanto', 'kelas' => 'XI RPL 3', 'no_telp' => '086210987654', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-10-26', 'username_user' => '1037'],
            ['nis' => '1038', 'nama' => 'Lia Kurniasih', 'kelas' => 'XI RPL 3', 'no_telp' => '086109876543', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-05-03', 'username_user' => '1038'],
            ['nis' => '1039', 'nama' => 'Mario Anggoro', 'kelas' => 'XI RPL 3', 'no_telp' => '086098765432', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-11-14', 'username_user' => '1039'],
            ['nis' => '1040', 'nama' => 'Niken Maharani', 'kelas' => 'XI RPL 3', 'no_telp' => '085987654321', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-12-05', 'username_user' => '1040'],
            ['nis' => '1041', 'nama' => 'Oka Wira', 'kelas' => 'XI RPL 3', 'no_telp' => '085876543210', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-09-17', 'username_user' => '1041'],
            ['nis' => '1042', 'nama' => 'Prita Salsabila', 'kelas' => 'XI RPL 3', 'no_telp' => '085765432109', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-04-13', 'username_user' => '1042'],
            ['nis' => '1043', 'nama' => 'Qasim Rahman', 'kelas' => 'XI RPL 3', 'no_telp' => '085654321098', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-07-30', 'username_user' => '1043'],
            ['nis' => '1044', 'nama' => 'Rani Oktaviani', 'kelas' => 'XI RPL 3', 'no_telp' => '085543210987', 'jenis_kelamin' => 'P', 'tgl_lahir' => '2006-01-10', 'username_user' => '1044'],
            ['nis' => '1045', 'nama' => 'Syahrul Anam', 'kelas' => 'XI RPL 3', 'no_telp' => '085432109876', 'jenis_kelamin' => 'L', 'tgl_lahir' => '2006-02-22', 'username_user' => '1045'],
        ];

        foreach ($data as $item) {
            Murid::updateOrCreate(
                ['nis' => $item['nis']],
                $item
            );
        }
    }
}