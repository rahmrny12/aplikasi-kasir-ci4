<?php 

namespace App\Database\Seeds;
 
class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'name'      => 'Rendy',
            'email'     => 'rendy@gmail.com',
            'password'  => '$2y$10$Ho8VWJQ5yGaLYMFRFfIOeu3Oj13Nc2JnklsZfGQyUrOeGCpt6CKXC'
        ];
        $this->db->table('user')
                 ->insert($data);
    }
} 