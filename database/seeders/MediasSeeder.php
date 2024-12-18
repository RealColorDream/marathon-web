<?php

namespace Database\Seeders;

use App\Enums\FormatMedia;
use App\Models\Etape;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediasSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $medias = [
            "Europe du Nord" => "/storage/user1/europe-nord.png",
            'Lens1' => "/storage/user1/Lens.jpg",
            'Bruxelles1' => "/storage/user1/Bruxelles1.jpg",
            'Bruxelles2' => "/storage/user1/Bruxelles2.jpg",
            'Anvers1' => "/storage/user1/Anvers1.jpg",
            "Anvers2" => "/storage/user1/Anvers2.jpg",
            "Amsterdam1" => "/storage/user1/Amsterdam1.jpg",
            'Amsterdam2' => "/storage/user1/Amsterdam2.jpg",
            "Amsterdam3" => "/storage/user1/Amsterdam3.jpg",
            'Hambourg1' => "/storage/user1/Hambourg.jpg",
            "Breme1" => "/storage/user1/breme.jpg",
            'Copenhague1' => "/storage/user1/copenhague.jpg",
            "Oslo1" => "/storage/user1/oslo.jpg",
        ];



        foreach ($medias as $nom => $url) {
            if ($nom === 'Europe du Nord') {
                continue;
            }
            $pattern = '/(\\D*)([0-9]+?)/';
            $success = preg_match($pattern, $nom, $match);
            if ($success) {
                $nom = $match[1];
            } else {
                continue;
            }
            $id = Etape::where('titre', $nom)->first();
            if ($id === null) {
                echo "EtapeController $nom non trouvée\n";
                continue;
            }
            //$nom = str_replace('.*([0-9]*)', '', $nom);
            //echo "$nom\n";
            Media::create([
                'titre' => $nom,
                'url' => env('APP_URL'). "$url",
                'etape_id' => Etape::where('titre', $nom)->first()->id,
            ]);
        }

        Media::create([
            'titre' => "Chant Supporteurs Lensois",
            'url' => "https://www.youtube.com/embed/T4I5xoQKnIo?si=pg-rp75lN35SZE9c",
            'etape_id' => 1,
            'format' => FormatMedia::VIDEO
        ]);
    }
}
