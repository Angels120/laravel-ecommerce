<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->delete();
        $cities = array(
            array('name' => "Arjundhara", 'province_id' => 1),
            array('name' => "Belbari", 'province_id' => 1),
            array('name' => "Bhadrapur", 'province_id' => 1),
            array('name' => "Biratnagar", 'province_id' => 1),
            array('name' => "Birtamod", 'province_id' => 1),
            array('name' => "Chandragadi", 'province_id' => 1),
            array('name' => "Damak", 'province_id' => 1),
            array('name' => "Dhankuta", 'province_id' => 1),
            array('name' => "Dharan", 'province_id' => 1),
            array('name' => "Dharan", 'province_id' => 1),
            array('name' => "Duhabi", 'province_id' => 1),
            array('name' => "Gauradaha", 'province_id' => 1),
            array('name' => "Ilam", 'province_id' => 1),
            array('name' => "Inaruwa", 'province_id' => 1),
            array('name' => "Itahari", 'province_id' => 1),
            array('name' => "Kakarbhitta", 'province_id' => 1),
            array('name' => "Kankai", 'province_id' => 1),
            array('name' => "Letang", 'province_id' => 1),
            array('name' => "Pathari", 'province_id' => 1),
            array('name' => "Rangeli", 'province_id' => 1),
            array('name' => "Ratuwamai", 'province_id' => 1),
            array('name' => "Shivasatakshi", 'province_id' => 1),
            array('name' => "Sunawarshi", 'province_id' => 1),
            array('name' => "Sundar Haraincha", 'province_id' => 1),
            array('name' => "Triyuga", 'province_id' => 1),
            array('name' => "Urlabari", 'province_id' => 1),

            //Province 2
            array('name' => "Bardibas", 'province_id' => 2),
            array('name' => "Bideha", 'province_id' => 2),
            array('name' => "Birgunj", 'province_id' => 2),
            array('name' => "Chandrapur", 'province_id' => 2),
            array('name' => "Chhirswarnath", 'province_id' => 2),
            array('name' => "Dhanushadham", 'province_id' => 2),
            array('name' => "Golbazar", 'province_id' => 2),
            array('name' => "Hansapur", 'province_id' => 2),
            array('name' => "Hariwan", 'province_id' => 2),
            array('name' => "Jaleswor", 'province_id' => 2),
            array('name' => "Janakpur", 'province_id' => 2),
            array('name' => "Jeetpur-Simara", 'province_id' => 2),
            array('name' => "Kalaiya", 'province_id' => 2),
            array('name' => "Lahan", 'province_id' => 2),
            array('name' => "Lalbandi", 'province_id' => 2),
            array('name' => "Malangwa", 'province_id' => 2),
            array('name' => "Mirchaiya", 'province_id' => 2),
            array('name' => "Mithila", 'province_id' => 2),
            array('name' => "Mithila Bihari", 'province_id' => 2),
            array('name' => "Mithila Nagarain", 'province_id' => 2),
            array('name' => "Rajbiraj", 'province_id' => 2),
            array('name' => "Sabaila", 'province_id' => 2),
            array('name' => "Shahidnagar", 'province_id' => 2),

            //Province 3
            array('name' => "Banepa", 'province_id' => 3),
            array('name' => "Bhaktapur", 'province_id' => 3),
            array('name' => "Bharatpur", 'province_id' => 3),
            array('name' => "Bhimeshwor-Charikot", 'province_id' => 3),
            array('name' => "Bidur", 'province_id' => 3),
            array('name' => "Hetauda", 'province_id' => 3),
            array('name' => "Kalika", 'province_id' => 3),
            array('name' => "Kamalamai", 'province_id' => 3),
            array('name' => "Kathmandy Metro 10 -New Baneshwor Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 11 -Maitighar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 12 -Teku Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 13 -Kalimati Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 14 -Kuleshwor Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 15 -Swayambhu Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 16 -Nayabazar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 17 -Chhetrapati Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 18 -Raktakali Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 19 -Hanumandhoka Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 1 -Naxal Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 20 -Marutol Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 21 -Lagantole Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 22 -Newroad Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 23 -Basantapur Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 24 -Indrachowk Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 25 -Ason Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 26 -Samakhushi Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 26 -Thamel Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 27 -Bhotahiti Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 28 -Bagbazar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 28 -Kamaladi Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 29 -Anamnagar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 29 -Putalisadak Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 2 -Lazimpat Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 30 -Maitidevi Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 31 -Min Bhawan Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 32 -Koteshwor Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 32 -Tinkune Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 3 -Baluwatar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 3 -Maharajgunj Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 4 -Bishalnagar Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 5 -Tangal Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 7 -Chabahil Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 8 -Gaushala Area", 'province_id' => 3),
            array('name' => "Kathmandy Metro 9 -Sinamangal Area", 'province_id' => 3),
            array('name' => "Kathmandu Outside Ring Road", 'province_id' => 3),
            array('name' => "Khairehani", 'province_id' => 3),
            array('name' => "Lalitpur Inside Ring Road", 'province_id' => 3),
            array('name' => "Lalitpur Outside Ring Road", 'province_id' => 3),
            array('name' => "Nikantha-Dhading", 'province_id' => 3),
            array('name' => "Panauti", 'province_id' => 3),
            array('name' => "Panchakhal", 'province_id' => 3),
            array('name' => "Rapti", 'province_id' => 3),
            array('name' => "Ratnanagar", 'province_id' => 3),

            //Province 4
            array('name' => "Gorkha Bazaar", 'province_id' => 4),
            array('name' => "Kawasoti", 'province_id' => 4),
            array('name' => "Kushma", 'province_id' => 4),
            array('name' => "Lekhnath", 'province_id' => 4),
            array('name' => "Pokhara", 'province_id' => 4),
            array('name' => "Putalibazar", 'province_id' => 4),
            array('name' => "Shuklagandaki", 'province_id' => 4),
            array('name' => "Sundarbazar", 'province_id' => 4),
            array('name' => "Waling", 'province_id' => 4),

            //Province 5
            array('name' => "Banganga", 'province_id' => 5),
            array('name' => "Bardaghat", 'province_id' => 5),
            array('name' => "Butwal", 'province_id' => 5),
            array('name' => "Dang-Ghorahi", 'province_id' => 5),
            array('name' => "Dang-Tulsipur", 'province_id' => 5),
            array('name' => "Devdaha", 'province_id' => 5),
            array('name' => "Kohalpur", 'province_id' => 5),
            array('name' => "Lamahi", 'province_id' => 5),
            array('name' => "Lumbini Sanskriti", 'province_id' => 5),
            array('name' => "Nepalgunj", 'province_id' => 5),
            array('name' => "Ramgram", 'province_id' => 5),
            array('name' => "Sainamaina", 'province_id' => 5),
            array('name' => "Shivaraj-Chanauta", 'province_id' => 5),
            array('name' => "Sidhathanagar-Bhairahawa", 'province_id' => 5),
            array('name' => "Sunwal", 'province_id' => 5),
            array('name' => "Tansen", 'province_id' => 5),
            array('name' => "Taulihawa-Kapilvastu", 'province_id' => 5),
            array('name' => "Tilotama", 'province_id' => 5),

            //Province 6
            array('name' => "Bheriganga", 'province_id' => 6),
            array('name' => "Birendranagar", 'province_id' => 6),
            array('name' => "Lekbesi", 'province_id' => 6),

            //Province 7
            array('name' => "Bhaijangi", 'province_id' => 7),
            array('name' => "Bhimdatta-Mahendranagar", 'province_id' => 7),
            array('name' => "Dhangadhi", 'province_id' => 7),
            array('name' => "Gauriganga", 'province_id' => 7),
            array('name' => "Ghodaghodi", 'province_id' => 7),
            array('name' => "Godawari", 'province_id' => 7),
            array('name' => "Lamki Chuha", 'province_id' => 7),
            array('name' => "Tikapur", 'province_id' => 7),


        );
        DB::table('cities')->insert($cities);
    }
}
