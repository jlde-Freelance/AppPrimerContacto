<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Location;
use App\Models\MasterOptions;
use Database\Factories\RealEstateFactory;
use App\Models\User;
use App\Types\MasterOptionsType;
use App\Types\UserProfile;
use Database\Factories\ResourceFileFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->createAdminUser();
        $this->loadMasterOptions();
        $this->loadLocations();
//        $this->createRealEstate();
//        $this->createResourceFile();
    }

    /**
     * This function is for create the user admin
     * @return void
     */
    private function createAdminUser(): void {
        User::query()->create([
            'name' => 'Administrador',
            'email' => 'admin@primercontacto.co',
            'phone' => '(+57) 100 200 3040',
            'profile' => UserProfile::ADMIN,
            'password' => Hash::make('PrimerContacto2023.*')
        ]);

        User::query()->create([
            'name' => 'Vigilante 1',
            'email' => 'vigilante1@primercontacto.co',
            'phone' => '(+57) 100 200 3040',
            'profile' => UserProfile::VIGILANT,
            'password' => Hash::make('Vigilante2023.*')
        ]);

        User::query()->create([
            'name' => 'Vigilante 2',
            'email' => 'vigilante2@primercontacto.co',
            'phone' => '(+57) 100 200 3040',
            'profile' => UserProfile::VIGILANT,
            'password' => Hash::make('Vigilante2023.*')
        ]);

    }

    /**
     * @return void
     */
    private function loadMasterOptions(): void {

        $TypeRealEstate = [
            'Apartaestudio',
            'Apartamento',
            'Bodega',
            'Cabaña',
            'Campestre',
            'Campos, Chacras y Quintas',
            'Casa',
            'Casa de Playa',
            'Chalet',
            'Condominio',
            'Consultorio',
            'Cortijo',
            'Dúplex',
            'Edificio',
            'Finca',
            'Finca - Hoteles',
            'Galpon Industrial',
            'Hostal',
            'Hoteles',
            'Local',
            'Lote',
            'Lote Comercial',
            'Oficina',
            'Penthouse',
            'Piso',
            'Terreno',
        ];
        $TypeRealEstateAction = [
            'Venta',
            'Arriendo',
            'Venta y Arriendo'
        ];
        $Stratum = array_combine(range(1, 7), array_map(fn($n) => "Estrato $n", range(1, 7)));
        $Specifications = [
            'Acceso pavimentado',
            'Admite mascotas',
            'Adosado',
            'Aire acondicionado',
            'Alarma',
            'Amoblado',
            'Árboles frutales',
            'Área Social',
            'Áreas Turísticas',
            'Armarios Empotrados',
            'Ascensor',
            'Balcón',
            'Baño auxiliar',
            'Baño en habitación principal',
            'Barbacoa / Parrilla / Quincho',
            'Barra estilo americano',
            'Biblioteca/Estudio',
            'Bifamiliar',
            'Bosque nativos',
            'Bungalow / pareado',
            'Calentador',
            'Calles de Tosca',
            'Cancha de baloncesto',
            'Cancha de futbol',
            'Cancha de squash',
            'Cancha de tenis',
            'Centros comerciales',
            'Cerca zona urbana',
            'Chimenea',
            'Circuito cerrado de TV',
            'Citófono / Intercomunicador',
            'Clósets',
            'Club House',
            'Club Social',
            'Cochera / Garaje',
            'Cocina equipada',
            'Cocina integral',
            'Cocina tipo americano',
            'Colegios / Universidades',
            'Comedor auxiliar',
            'Depósito',
            'Despensa',
            'Doble Ventana',
            'Establo',
            'Galpón',
            'Garaje',
            'Garita de Entrada',
            'Gas domiciliario',
            'Gimnasio',
            'Gym',
            'Habitación conductores',
            'Habitación servicio',
            'Hall de alcobas',
            'Hospedaje Turismo',
            'Invernadero',
            'Jacuzzi',
            'Jardín',
            'Jaula de golf',
            'Juegos de niños',
            'Kiosko',
            'Lago',
            'Laguna',
            'Montaña',
            'Oficina de negocios',
            'Parqueadero visitantes',
            'Parques cercanos',
            'Patio',
            'Pesebrera',
            'Piscina',
            'Pista de Padel',
            'Planta eléctrica',
            'Playas',
            'Portería / Recepción',
            'Pozo de agua natural',
            'Reformado',
            'Río/Quebrada cercano',
            'Sala de internet',
            'Salón Comunal',
            'Sauna',
            'Sistema de riego',
            'Sobre vía principal',
            'Spa',
            'Suelo de cerámica / mármol',
            'Terraza',
            'Trans. público cercano',
            'Trastero',
            'Trifamiliar',
            'Turco',
            'Unifamiliar',
            'Urbanización Cerrada',
            'Vigilancia',
            'Vista panorámica',
            'Vivienda bifamiliar',
            'Vivienda multifamiliar',
            'Vivienda unifamiliar',
            'Zona campestre',
            'Zona camping',
            'Zona comercial',
            'Zona de lavandería',
            'Zona industrial',
            'Zona infantil',
            'Zona residencial',
            'Zonas deportivas',
            'Zonas verdes',
        ];

        $Items = [];

        foreach ($TypeRealEstate as $key => $value) {
            $Items[] = [
                'type' => MasterOptionsType::TYPE_REAL_ESTATE,
                'key' => Str::slug($value), 'value' => $value, 'order' => $key + 1
            ];
        }
        foreach ($TypeRealEstateAction as $key => $value) {
            $Items[] = [
                'type' => MasterOptionsType::TYPE_REAL_ESTATE_ACTION,
                'key' => Str::slug($value), 'value' => $value, 'order' => $key + 1
            ];
        }
        foreach ($Stratum as $key => $value) {
            $Items[] = [
                'type' => MasterOptionsType::TYPE_STRATUM,
                'key' => Str::slug($value), 'value' => $value, 'order' => $key
            ];
        }

        foreach ($Items as $Item) {
            MasterOptions::create($Item);
        }

        foreach ($Specifications as $key => $item) {
            if (is_array($item)) {
                $created = MasterOptions::create([
                    'type' => MasterOptionsType::TYPE_SPECIFICATIONS,
                    'key' => Str::slug($key),
                    'value' => $key,
                    'order' => $key + 1,
                    'children' => true
                ]);
                foreach ($item as $C => $subItem) {
                    MasterOptions::create([
                        'type' => MasterOptionsType::TYPE_SPECIFICATIONS,
                        'key' => Str::slug($subItem),
                        'parent_id' => $created->id,
                        'value' => $subItem,
                        'order' => $C++
                    ]);
                }
            } else {
                MasterOptions::create([
                    'type' => MasterOptionsType::TYPE_SPECIFICATIONS,
                    'key' => Str::slug($item),
                    'value' => $item,
                    'order' => $key + 1
                ]);
            }
        }

    }

    private function createRealEstate(): void {
        RealEstateFactory::new()->count(1000)->create();
    }

    private function createResourceFile(): void {
        ResourceFileFactory::new()->count(123)->create();
    }

    /*
     * @return void
     */
    private function loadLocations() {
        if (($handle = fopen(storage_path('app/resources/locations.csv'), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1500)) !== FALSE) {
                Location::create([
                    'department_dane' => $data[0],
                    'department_name' => $data[1],
                    'municipality_dane' => $data[2],
                    'municipality_name' => $data[3]
                ]);
            }
            fclose($handle);
        }
    }

}
