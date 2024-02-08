<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubRegion;
class SubRegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //SubRegion::truncate();
        //\DB::table('sub_regions')->delete();
        SubRegion::insert([
            [
                'name' => 'Mekka Mukaramah City',                        
                'region_id' => 1, 
                'lat'=>'21.3890824',
                'long'=>'39.8579118',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Jeddah',                        
                'region_id' => 1, 
                'lat'=>'21.485811',
                'long'=>'39.1925048',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Taif',                        
                'region_id' => 1,
                'lat'=>'21.2840782',
                'long'=>'40.4248192', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Layth',                        
                'region_id' => 1, 
                'lat'=>'14.34331',
                'long'=>'43.85091',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Rabigh',                        
                'region_id' => 1, 
                'lat'=>'22.7906701',
                'long'=>'39.0189623	',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Khalees',                        
                'region_id' => 1, 
                'lat'=>'42.352832799999995',
                'long'=>'42.352832799999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Khurmah',                        
                'region_id' => 1,
                'lat'=>'21.9',
                'long'=>'42.0333333	', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Raniah',                        
                'region_id' => 1, 
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Turabah',                        
                'region_id' => 1, 
                'lat'=>'21.2075957',
                'long'=>'41.62114',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Jemoum',                        
                'region_id' => 1, 
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Kamel',                        
                'region_id' => 1, 
                'lat'=>'24.797413',
                'long'=>'46.660152',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mouaih',                        
                'region_id' => 1, 
                'lat'=>'',
                'long'=>'',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Maysan',                        
                'region_id' => 1, 
                'lat'=>'31.8379012',
                'long'=>'47.1420675	',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Adham',                        
                'region_id' => 1, 
                'lat'=>'13.15074',
                'long'=>'44.0581',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al-Ardiyat',                        
                'region_id' => 1, 
                'lat'=>'19.3547808',
                'long'=>'41.6809724	',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bahrah',                        
                'region_id' => 1,
                'lat'=>'21.4022801',
                'long'=>'39.4628528', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Riyadh',                        
                'region_id' => 2, 
                'lat'=>'24.7135517',
                'long'=>'46.6752957',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dirayah',                        
                'region_id' => 2, 
                'lat'=>'24.7481198',
                'long'=>'46.5363345',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Kharj',                        
                'region_id' => 2, 
                'lat'=>'24.1576043',
                'long'=>'47.3247876',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dawadmi',                        
                'region_id' => 2, 
                'lat'=>'24.5167005',
                'long'=>'44.4181786',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mejmaah',                        
                'region_id' => 2, 
                'lat'=>'25.8758866',
                'long'=>'45.3730695',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Quwaiyah',                        
                'region_id' => 2, 
                'lat'=>'24.067056',
                'long'=>'45.2806177',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Aflaj',                        
                'region_id' => 2, 
                'lat'=>'21.980883',
                'long'=>'46.850515',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Wadi Al Dewaser',                        
                'region_id' => 2, 
                'lat'=>'20.4492858',
                'long'=>'44.8501154',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Zulfi',                        
                'region_id' => 2, 
                'lat'=>'26.3098543',
                'long'=>'44.831834',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Shaqra',                        
                'region_id' => 2,
                'lat'=>'25.2476471',
                'long'=>'45.2524792', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
              'name' => 'Huwtat bani Tamim',                        
                'region_id' => 2, 
                'lat'=>'23.525188',
                'long'=>'46.8446611',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Afeef',                        
                'region_id' => 2, 
                'lat'=>'24.8054298',
                'long'=>'67.111266',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ghat',                        
                'region_id' => 2, 
                'lat'=>'26.02893',
                'long'=>'44.94685',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sulayal',                        
                'region_id' => 2, 
                'lat'=>'24.6571726',
                'long'=>'46.8344515',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dharuma',                        
                'region_id' => 2, 
                'lat'=>'',
                'long'=>'',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Muzahmiyah',                        
                'region_id' => 2, 
                'lat'=>'24.4713948',
                'long'=>'46.2732342',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Rumah',                        
                'region_id' => 2, 
                'lat'=>'25.56395',
                'long'=>'47.16408',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Thadiq',                        
                'region_id' => 2, 
                'lat'=>'25.2794256',
                'long'=>'45.870706',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Huraymla',                        
                'region_id' => 2, 
                'lat'=>'25.1157976',
                'long'=>'46.10403',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hareeq',                        
                'region_id' => 2, 
                'lat'=>'23.6245445',
                'long'=>'46.5114487',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Marat',                        
                'region_id' => 2, 
                'lat'=>'25.07007',
                'long'=>'45.46147',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Reen',                        
                'region_id' => 2, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dulam',                        
                'region_id' => 2, 
                'lat'=>'25.2148838',
                'long'=>'55.3329125',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Ahsa',                        
                'region_id' => 3, 
                'lat'=>'3.139917',
                'long'=>'30.699143',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hafr Albaten',                        
                'region_id' => 3, 
                'lat'=>'24.760606',
                'long'=>'46.570603',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Jubail',                        
                'region_id' => 3, 
                'lat'=>'27.0006968',
                'long'=>'49.6532161',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Qatif',                        
                'region_id' => 3,
                'lat'=>'26.616667',
                'long'=>'49.933333', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Khobar',                        
                'region_id' => 3, 
                'lat'=>'26.3039999',
                'long'=>'50.1960237',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Khafji',                        
                'region_id' => 3, 
                'lat'=>'28.4225409',
                'long'=>'48.4927814',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ras Tenourah',                        
                'region_id' => 3, 
                'lat'=>'21.422443',
                'long'=>'39.789446',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Abqaiq',                        
                'region_id' => 3, 
                'lat'=>'25.935556',
                'long'=>'49.668333',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Nayriyah',                        
                'region_id' => 3, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Qaryat Al Olaya',                        
                'region_id' => 3, 
                'lat'=>'24.805149',
                'long'=>'46.655082',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Udaid',                        
                'region_id' => 3, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Baydha',                        
                'region_id' => 3, 
                'lat'=>'25.361158',
                'long'=>'55.392181',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Medinah Monourah City',                        
                'region_id' => 4, 
                'lat'=>'24.471971',
                'long'=>'39.61254',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Yanbu',                        
                'region_id' => 4, 
                'lat'=>'24.0889015',
                'long'=>'38.0666798',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ulaa',                        
                'region_id' => 4, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mahed',                        
                'region_id' => 4, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Henakiyah',                        
                'region_id' => 4, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Badr',                        
                'region_id' => 4, 
                'lat'=>'23.78',
                'long'=>'38.7907409',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Khaiber',                        
                'region_id' => 4, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Aeess',                        
                'region_id' => 4, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Wadi Al Faraa',                        
                'region_id' => 4, 
                'lat'=>'24.553551',
                'long'=>'46.687604',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Unaizah',                        
                'region_id' => 5, 
                'lat'=>'26.089978',
                'long'=>'43.9864092',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Rass',                        
                'region_id' => 5, 
                'lat'=>'24.4894784',
                'long'=>'46.6170911',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Methnab',                        
                'region_id' => 5, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bekariyah',                        
                'region_id' => 5, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bedaiya',                        
                'region_id' => 5, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Asyah',                        
                'region_id' => 5, 
                'lat'=>'24.7365623',
                'long'=>'46.7608487',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Nabhaniyah',                        
                'region_id' => 5, 
                'lat'=>'25.86088',
                'long'=>'43.0663784',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Shemasiyah',                        
                'region_id' => 5, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ayoun Aljwa',                        
                'region_id' => 5, 
                'lat'=>'24.575969',
                'long'=>'46.881922',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Riyadh Alkhabra',                        
                'region_id' => 5, 
                'lat'=>'24.843156',
                'long'=>'46.765934',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Uqlat Alsagour',                        
                'region_id' => 5, 
                'lat'=>'26.78984',
                'long'=>'42.05899',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dhuraiah',                        
                'region_id' => 5, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hayil City',                        
                'region_id' => 6, 
                'lat'=>'27.5208716',
                'long'=>'41.6985992',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Beqaa',                        
                'region_id' => 6, 
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ghazalah',                        
                'region_id' => 6, 
                'lat'=>'26.78372155',
                'long'=>'41.218541560945106',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Shenan',                        
                'region_id' => 6, 
                'lat'=>'24.7614087',
                'long'=>'46.7844208',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hayt',                        
                'region_id' => 6, 
                'lat'=>'26.3147984',
                'long'=>'43.9183296',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sulaimi',                        
                'region_id' => 6, 
                'lat'=>'26.283333',
                'long'=>'41.35',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Shemli',                        
                'region_id' => 6,
                'lat'=>'23.801889',
                'long'=>'44.708041', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Muqeq',                        
                'region_id' => 6, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sumaira',                        
                'region_id' => 6,
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Khamis Mushait',                        
                'region_id' => 7, 
                'lat'=>'18.297040500259932',
                'long'=>'42.7366896',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Beesha',                        
                'region_id' => 7,
                'lat'=>'23.801889',
                'long'=>'44.708041', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Numass',                        
                'region_id' => 7, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mehayal Aseer',                        
                'region_id' => 7,
                'lat'=>'18.532784389743302',
                'long'=>'42.048990679844586', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dhahran Al Janoub',                        
                'region_id' => 7, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tathleeth',                        
                'region_id' => 7,
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sarat Abeedah',                        
                'region_id' => 7,
                'lat'=>'18.084204',
                'long'=>'43.138539', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Rajal Almaa',                        
                'region_id' => 7, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Balqarn',                        
                'region_id' => 7,
                'lat'=>'19.717550099999997',
                'long'=>'41.960629999999995', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ahd Rfaidah',                        
                'region_id' => 7, 
                'lat'=>'24.576591',
                'long'=>'46.593608',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mejardeh',                        
                'region_id' => 7,
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Berk',                        
                'region_id' => 7, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bareq',                        
                'region_id' => 7, 
                'lat'=>'24.78185',
                'long'=>'46.69944',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tanomah',                        
                'region_id' => 7, 
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tareeb',                        
                'region_id' => 7,
                'lat'=>'25.624261800201314',
                'long'=>'42.352832799999995', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Harjah',                        
                'region_id' => 7,
                'lat'=>'18.028545100000002',
                'long'=>'43.499944933925725', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Najran City',                        
                'region_id' => 8,
                'lat'=>'17.543980900190903',
                'long'=>'44.22468169999999', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sherourah',                        
                'region_id' => 8, 
                'lat'=>'18.85959740030441',
                'long'=>'51.123511099999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hebouna',                        
                'region_id' => 8, 
                'lat'=>'17.78333300021391',
                'long'=>'44.2',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Badr Al Janounb',                        
                'region_id' => 8, 
                'lat'=>'17.800000000215476',
                'long'=>'43.733332999999995',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Yedmah',                        
                'region_id' => 8,
                'lat'=>'25.258104',
                'long'=>'55.324916', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Thaar',                        
                'region_id' => 8, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Khebash',                        
                'region_id' => 8, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'ALL',                        
                'region_id' => 9,
                'lat'=>'23.801889',
                'long'=>'44.708041', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Jaizan City',                        
                'region_id' => 9, 
                'lat'=>'16.894719',
                'long'=>'42.5579758',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sabyaa',                        
                'region_id' => 9,
                'lat'=>'25.258104',
                'long'=>'55.324916', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Abu Areesh',                        
                'region_id' => 9, 
                'lat'=>'24.76942',
                'long'=>'46.747666',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Samttah',                        
                'region_id' => 9, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Beesh',                        
                'region_id' => 9,
                'lat'=>'35.1629186',
                'long'=>'33.3453114',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Darb',                        
                'region_id' => 9,
                'lat'=>'35.1629186',
                'long'=>'33.3453114', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Harth',                        
                'region_id' => 9, 
                'lat'=>'16.78420395',
                'long'=>'43.15250768497026',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dhamad',                        
                'region_id' => 9, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Rayth',                        
                'region_id' => 9, 
                'lat'=>'17.603945',
                'long'=>'42.8566753',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Farsan',                        
                'region_id' => 9,
                'lat'=>'24.5780905',
                'long'=>'46.6681376', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Daeer',                        
                'region_id' => 9, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ardhah',                        
                'region_id' => 9, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ahd Masarha',                        
                'region_id' => 9, 
                'lat'=>'24.576591',
                'long'=>'46.593608',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Aydabi',                        
                'region_id' => 9, 
                'lat'=>'17.2352185',
                'long'=>'42.9404299',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tawal',                        
                'region_id' => 9, 
                'lat'=>'26.015174',
                'long'=>'42.3690239',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Heroub',                        
                'region_id' => 9, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Fayfa',                        
                'region_id' => 9,
                'lat'=>'31.261161',
                'long'=>'32.290699', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tabouk City',                        
                'region_id' => 10, 
                'lat'=>'28.4012536',
                'long'=>'36.567049',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Wajh',                        
                'region_id' => 10, 
                'lat'=>'26.62706335',
                'long'=>'36.66529000798626',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Dheba',                        
                'region_id' => 10, 
                'lat'=>'25.489323',
                'long'=>'55.581602',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tayma',                        
                'region_id' => 10, 
                'lat'=>'27.6225952',
                'long'=>'38.539257',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Umloj',                        
                'region_id' => 10, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Haql',                        
                'region_id' => 10, 
                'lat'=>'29.2864157',
                'long'=>'34.9469118',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bedaa',                        
                'region_id' => 10,
                'lat'=>'25.291909',
                'long'=>'55.337148', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Neom',                        
                'region_id' => 10,
                'lat'=>'28.0058861',
                'long'=>'35.2027014', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Sharma',                        
                'region_id' => 10, 
                'lat'=>'28.0306558',
                'long'=>'35.242029',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Skaka',                        
                'region_id' => 11, 
                'lat'=>'29.9784008',
                'long'=>'40.2047701',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Qurayat',                        
                'region_id' => 11,
                'lat'=>'24.6284336',
                'long'=>'46.7375196',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Diumat Al-Jandal',                        
                'region_id' => 11, 
                'lat'=>'24.697807',
                'long'=>'46.694975',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Tabarjal',                        
                'region_id' => 11, 
                'lat'=>'30.5006757',
                'long'=>'38.2165051',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Arar',                        
                'region_id' => 12, 
                'lat'=>'30.916667',
                'long'=>'41.5',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Rafhaa',                        
                'region_id' => 12, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Turaif',                        
                'region_id' => 12,
                'lat'=>'31.67252',
                'long'=>'38.66374', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Uwaiqlayah',                        
                'region_id' => 12, 
                'lat'=>'23.801889',
                'long'=>'44.708041',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Al Baha City',                        
                'region_id' => 13, 
                'lat'=>'24.759839',
                'long'=>'46.566222',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Beljurashi',                        
                'region_id' => 13, 
                'lat'=>'31.261161',
                'long'=>'32.290699',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mandeg',                        
                'region_id' => 13, 
                'lat'=>'25.258104',
                'long'=>'55.324916',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Mekhoat',                        
                'region_id' => 13,
                'lat'=>'25.291909',
                'long'=>'55.337148', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Qelwat',                        
                'region_id' => 13, 
                'lat'=>'24.490053',
                'long'=>'54.379399',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Aqiq',                        
                'region_id' => 13, 
                'lat'=>'20.2836432',
                'long'=>'41.6560108',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Quraa',                        
                'region_id' => 13,
                'lat'=>'21.4397358',
                'long'=>'39.8101771', 
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Ghamid Zenad',                        
                'region_id' => 13, 
                'lat'=>'21.415142',
                'long'=>'39.822446',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Hajrat',                        
                'region_id' => 13, 
                'lat'=>'27.782477',
                'long'=>'45.036749',
                'arabic_name'=>'',
                'status' => 1, 
            ],[
                'name' => 'Bani Hasan',                        
                'region_id' => 13, 
                'lat'=>'20.091223149',
                'long'=>'41.368903975',
                'arabic_name'=>'',
                'status' => 1, 
            ]
             
        ]);
    }
}
 