<?php
namespace Database\Seeders;

use App\Models\City;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
	
	$products = [
    ['name' => 'Miltai', 'description' => 'Aukštos kokybės kvietiniai miltai.', 'category_id' => 1], // Maistas
    ['name' => 'Skalbimo mašina', 'description' => 'Energiją taupanti skalbimo mašina su garų funkcija.', 'category_id' => 4], // Buitinė technika
    ['name' => 'PVC vamzdis', 'description' => 'Tvirtas ir patvarus vamzdis vandentiekio sistemoms.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Lova', 'description' => 'Miegamojo lova su čiužiniu ir laikymo dėže.', 'category_id' => 5], // Baldai
    ['name' => 'Dviračio šalmas', 'description' => 'Lengvas, bet tvirtas šalmas aktyviam sportui.', 'category_id' => 6], // Sportas
    ['name' => 'Televizorius', 'description' => '55 colių išmanusis televizorius su 4K raiška.', 'category_id' => 3], // Elektronika
    ['name' => 'Marškinėliai', 'description' => 'Medvilniniai marškinėliai kasdieniam dėvėjimui.', 'category_id' => 2], // Drabužiai
    ['name' => 'Kava', 'description' => 'Malta arabikos kava iš Kolumbijos.', 'category_id' => 1], // Maistas
    ['name' => 'Šaldytuvas', 'description' => 'A++ klasės dviejų durų šaldytuvas.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Sportbačiai', 'description' => 'Lengvi ir patogūs sportiniai bateliai.', 'category_id' => 2], // Drabužiai
    ['name' => 'Kavos aparatas', 'description' => 'Automatinis kavos aparatas su įvairiais paruošimo režimais.', 'category_id' => 3], // Elektronika
    ['name' => 'Kėdė', 'description' => 'Patogi kėdė darbui ar poilsiui.', 'category_id' => 5], // Baldai
    ['name' => 'Masažuoklis', 'description' => 'Elektrinis masažuoklis, skirtas kūno atpalaidavimui.', 'category_id' => 3], // Elektronika
    ['name' => 'Kambario lemputė', 'description' => 'Stilinga lemputė su šiltu šviesos tonu.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Kompiuteris', 'description' => 'Galingas kompiuteris darbui ir pramogoms.', 'category_id' => 3], // Elektronika
    ['name' => 'Stalas', 'description' => 'Ergonomiškas darbo stalas su papildomomis lentynomis.', 'category_id' => 5], // Baldai
    ['name' => 'Telefonas', 'description' => 'Naujausio modelio išmanusis telefonas su aukštos raiškos kamera.', 'category_id' => 3], // Elektronika
    ['name' => 'Skalbyklė', 'description' => 'Naujos kartos skalbyklė su automatiniu vandens kiekiu.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Plaukų džiovintuvas', 'description' => 'Galingas plaukų džiovintuvas su keliais greičiais.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Palaidinė', 'description' => 'Šilta ir patogi palaidinė kasdieniam dėvėjimui.', 'category_id' => 2], // Drabužiai
    ['name' => 'Lentyna', 'description' => 'Stilinga lentyna, skirta knygoms ir dekoracijoms.', 'category_id' => 5], // Baldai
    ['name' => 'Virdulys', 'description' => 'Greitas ir patogus elektrinis virdulys.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Vakuuminis siurblys', 'description' => 'Efektyvus vakuuminis siurblys drabužiams ir kitoms prekei laikyti.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Kepimo skarda', 'description' => 'Patogi ir lengva kepimo skarda su nesvylančiu paviršiumi.', 'category_id' => 1], // Maistas
    ['name' => 'Mikrobangų krosnelė', 'description' => 'Kompaktiška mikrobangų krosnelė su įvairiais kaitinimo režimais.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Žadintuvas', 'description' => 'Elektroninis žadintuvas su keliais garsumo nustatymais.', 'category_id' => 3], // Elektronika
    ['name' => 'Saldainiai', 'description' => 'Skanių saldainių rinkinys su įvairiais skoniais.', 'category_id' => 1], // Maistas
    ['name' => 'Lentelė', 'description' => 'Mobili lentelė su aukščio reguliavimu.', 'category_id' => 5], // Baldai
    ['name' => 'Rūbų spinta', 'description' => 'Ergonomiška ir talpi rūbų spinta.', 'category_id' => 5], // Baldai
    ['name' => 'Nešiojamasis kompiuteris', 'description' => 'Kompiuteris su ilga baterijos veikimo trukme ir dideliu ekranu.', 'category_id' => 3], // Elektronika
    ['name' => 'Grilis', 'description' => 'Elektrinis grilis su įvairiomis kepimo funkcijomis.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Plaukų kirpimo mašina', 'description' => 'Aukštos kokybės plaukų kirpimo mašina su keičiamais priedais.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Tualeto popierius', 'description' => 'Minkštas ir sugeriantis tualeto popierius.', 'category_id' => 1], // Maistas
    ['name' => 'Langų valiklis', 'description' => 'Efektyvus langų valiklis su purškimo funkcija.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Akiniai', 'description' => 'Modernūs ir patogūs akiniai nuo saulės.', 'category_id' => 2], // Drabužiai
    ['name' => 'Vaikiški batai', 'description' => 'Patogūs ir stilingi batai vaikams.', 'category_id' => 2], // Drabužiai
    ['name' => 'Stiklinė', 'description' => 'Elegantiška stiklinė karštoms gėrimas.', 'category_id' => 1], // Maistas
    ['name' => 'Rankšluostis', 'description' => 'Minkštas ir sugeriantis rankšluostis.', 'category_id' => 2], // Drabužiai
    ['name' => 'Grilis', 'description' => 'Naujos kartos grilis su uždara kepimo sistema.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Kavos puodeliai', 'description' => 'Porcelianiniai kavos puodeliai elegantišku dizainu.', 'category_id' => 1], // Maistas
    ['name' => 'Lova su čiužiniu', 'description' => 'Komfortiška lova su aukščiausios kokybės čiužiniu.', 'category_id' => 5], // Baldai
    ['name' => 'Kavos filtras', 'description' => 'Aukštos kokybės kavos filtrai, užtikrinantys geriausią skonį.', 'category_id' => 1], // Maistas
    ['name' => 'Katilas', 'description' => 'Elektrinis katilas su greito kaitinimo funkcija.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Pieninė', 'description' => 'Pieninė su patogiu dangčiu ir šaldymo funkcija.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Stalo įrankiai', 'description' => 'Aukštos kokybės stalo įrankiai kasdieniam naudojimui.', 'category_id' => 1], // Maistas
    ['name' => 'Kėdė su ratukais', 'description' => 'Patogi darbo kėdė su ratukais ir ergonomišku dizainu.', 'category_id' => 5], // Baldai
    ['name' => 'Vėdinimo sistema', 'description' => 'Efektyvi vėdinimo sistema namams ir biurams.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Virdulys su ekranu', 'description' => 'Elektrinis virdulys su temperatūros ekranu.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Džiovintuvas', 'description' => 'Plaukų džiovintuvas su aukštu oro srauto reguliavimu.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Dulkių siurblys', 'description' => 'Galingas dulkių siurblys su HEPA filtru.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Pirties kostiumas', 'description' => 'Pirties kostiumas su natūraliais audiniais.', 'category_id' => 2], // Drabužiai
    ['name' => 'Bluetooth ausinės', 'description' => 'Komfortiškos ir aukštos kokybės Bluetooth ausinės su ilga baterijos veikimo trukme.', 'category_id' => 3], // Elektronika
    ['name' => 'Vakuuminis maišelis', 'description' => 'Efektyvus vakuuminis maišelis, skirtas drabužių ir daiktų laikymui.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Vaikiška lova', 'description' => 'Patogi ir saugi vaikiška lova su šoninėmis apsaugomis.', 'category_id' => 5], // Baldai
    ['name' => 'Grindų plovimo mašina', 'description' => 'Lengvai naudojama grindų plovimo mašina su vandens ir muilo kontrolės funkcija.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Kondicionierius', 'description' => 'Energiją taupantis kondicionierius su oro valymo sistema.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Šaldiklis', 'description' => 'Didelis ir talpus šaldiklis su keliomis lentynomis.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Maisto smulkintuvas', 'description' => 'Galingas maisto smulkintuvas, skirtas greitai ir patogiai paruošti ingredientus.', 'category_id' => 1], // Maistas
    ['name' => 'Džiovintuvai', 'description' => 'Naujoviški džiovintuvai, skirti greitam drabužių džiovinimui.', 'category_id' => 4], // Buitinė technika
    ['name' => 'Jogos kilimėlis', 'description' => 'Aukštos kokybės jogos kilimėlis, užtikrinantis komfortą ir stabilumą pratimams.', 'category_id' => 6], // Sportas
    ['name' => 'Sporto laikrodis', 'description' => 'Multifunkcinis sporto laikrodis su širdies ritmo matuokliu ir GPS.', 'category_id' => 6], // Sportas
];
			foreach ($products as $productData) {
            Product::factory()->create([
                'name' => $productData['name'],
                'description' => $productData['description'],
				'category_id' => $productData['category_id'],
            ]);
        }
    }
}
