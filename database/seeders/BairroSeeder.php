<?php

namespace Database\Seeders;

use App\Models\Bairro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BairroSeeder extends Seeder
{
    public function run()
    {
        $dir = __DIR__;
        Bairro::create(['nome' => 'Teste','taxa' =>5.00]);
        try {
            $handle = fopen("{$dir}\..\..\public\storagse\bairros.csv", "r");
            while ($line = fgetcsv($handle, 1000, ",")) {
                $bairro = Bairro::firstOrNew(['nome' => $line[0]]);
                $bairro->taxa = $line[1];
                $bairro->save();
            }
            fclose($handle);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
