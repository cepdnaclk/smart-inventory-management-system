# run in linux

outputFile = open("../database/seeders/ConsumableItemSeeder.php","w")

outputFile.write("""<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConsumableItemSeeder extends Seeder
{
    protected $data = [
""")

id = 1001

inputData = '''10Ω	100	0.50	50.00	TRUE	TRUE
               22Ω	100	0.50	50.00	TRUE	TRUE
               47Ω	100	0.50	50.00	TRUE	TRUE
               68Ω	100	0.50	50.00	TRUE	TRUE
               100Ω	100	0.50	50.00	TRUE	TRUE
               150Ω	100	0.50	50.00	TRUE	TRUE
               220Ω	100	0.50	50.00	TRUE	TRUE
               270Ω	100	0.50	50.00	TRUE	TRUE
               330Ω	100	0.50	50.00	TRUE	FALSE
               470Ω	100	0.50	50.00	TRUE	TRUE
               510Ω	100	0.50	50.00	TRUE	TRUE
               680Ω	100	0.50	50.00	TRUE	TRUE
               1KΩ	100	0.50	50.00	TRUE	TRUE
               2.2KΩ	100	0.50	50.00	TRUE	TRUE
               3.3KΩ	100	0.50	50.00	TRUE	TRUE
               4.7KΩ	100	0.50	50.00	TRUE	TRUE
               5.1KΩ	100	0.50	50.00	TRUE	TRUE
               6.8KΩ	100	0.50	50.00	TRUE	TRUE
               10KΩ	100	0.50	50.00	TRUE	TRUE
               22KΩ	100	0.50	50.00	TRUE	FALSE
               33KΩ	100	0.50	50.00	TRUE	TRUE
               47KΩ	100	0.50	50.00	TRUE	TRUE
               51KΩ	100	0.50	50.00	TRUE	TRUE
               68KΩ	100	0.50	50.00	TRUE	TRUE
               100KΩ	100	0.50	50.00	TRUE	TRUE
               220KΩ	100	0.50	50.00	TRUE	TRUE
               330KΩ	100	0.50	50.00	TRUE	TRUE
               470KΩ	100	0.50	50.00	TRUE	TRUE
               510KΩ	100	0.50	50.00	TRUE	TRUE
               680KΩ	100	0.50	50.00	TRUE	TRUE
               1MΩ	100	0.50	50.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} resistor', 'quantity' => '{quantity}', 'specifications' => '', 'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '12'),\n")
   id += 1

inputData = '''10Ω	100	0.50	50.00	TRUE	TRUE
               22Ω	100	0.50	50.00	TRUE	FALSE
               47Ω	100	0.50	50.00	TRUE	FALSE
               68Ω	100	0.50	50.00	TRUE	FALSE
               100Ω	100	0.50	50.00	TRUE	TRUE
               150Ω	100	0.50	50.00	TRUE	TRUE
               220Ω	100	0.50	50.00	TRUE	TRUE
               270Ω	100	0.50	50.00	TRUE	FALSE
               330Ω	100	0.50	50.00	TRUE	TRUE
               470Ω	100	0.50	50.00	TRUE	TRUE
               510Ω	100	0.50	50.00	TRUE	FALSE
               680Ω	100	0.50	50.00	TRUE	TRUE
               1KΩ	100	0.50	50.00	TRUE	FALSE
               2.2KΩ	100	0.50	50.00	TRUE	TRUE
               3.3KΩ	100	0.50	50.00	TRUE	TRUE
               4.7KΩ	100	0.50	50.00	TRUE	TRUE
               5.1KΩ	100	0.50	50.00	TRUE	FALSE
               6.8KΩ	100	0.50	50.00	TRUE	TRUE
               10KΩ	100	0.50	50.00	TRUE	FALSE
               22KΩ	100	0.50	50.00	TRUE	TRUE
               33KΩ	100	0.50	50.00	TRUE	TRUE
               47KΩ	100	0.50	50.00	TRUE	TRUE
               51KΩ	100	0.50	50.00	TRUE	FALSE
               68KΩ	100	0.50	50.00	TRUE	TRUE
               100KΩ	100	0.50	50.00	TRUE	TRUE
               220KΩ	100	0.50	50.00	TRUE	TRUE
               330KΩ	100	0.50	50.00	TRUE	TRUE
               470KΩ	100	0.50	50.00	TRUE	TRUE
               510KΩ	100	0.50	50.00	TRUE	TRUE
               680KΩ	100	0.50	50.00	TRUE	TRUE
               1MΩ	100	0.50	50.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} resistor', 'quantity' => '{quantity}', 'specifications' => '', 'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '13'),\n")
   id += 1

inputData = '''0.1uF	50	1.50	75.00	TRUE	FALSE
               0.22uF	50	1.50	75.00	TRUE	FALSE
               0.33uF	50	1.50	75.00	TRUE	FALSE
               0.47uF	50	1.50	75.00	TRUE	FALSE
               2.2uF	50	1.50	75.00	TRUE	FALSE
               3.3uF	50	2.00	100.00	TRUE	FALSE
               4.7uF	50	2.00	100.00	TRUE	FALSE
               10uF	50	1.50	75.00	TRUE	TRUE
               22uF	50	1.50	75.00	TRUE	TRUE
               47uF	50	1.50	75.00	TRUE	TRUE
               100uF	50	3.00	150.00	TRUE	TRUE
               220uF	50	3.50	175.00	TRUE	TRUE
               330uF	50	3.00	150.00	TRUE	TRUE
               470uF	50	3.50	175.00	TRUE	TRUE
               1000uF	50	10.00	500.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206', 'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '15'),\n")
   id += 1

inputData = '''100	50	0.75	37.50	TRUE	FALSE
               200	50	0.75	37.50	TRUE	FALSE
               300	50	0.75	37.50	TRUE	FALSE
               470	50	0.75	37.50	TRUE	FALSE
               680	50	0.75	37.50	TRUE	FALSE
               101	50	0.75	37.50	TRUE	FALSE
               221	50	0.75	37.50	TRUE	FALSE
               331	50	0.75	37.50	TRUE	FALSE
               471	50	0.75	37.50	TRUE	TRUE
               681	50	0.75	37.50	TRUE	FALSE
               102	50	0.75	37.50	TRUE	FALSE
               222	50	0.75	37.50	TRUE	FALSE
               332	50	0.75	37.50	TRUE	FALSE
               472	50	0.75	37.50	TRUE	FALSE
               682	50	0.75	37.50	TRUE	FALSE
               103	50	0.75	37.50	TRUE	FALSE
               223	50	0.75	37.50	TRUE	FALSE
               333	50	0.75	37.50	TRUE	FALSE
               473	50	0.75	37.50	TRUE	FALSE
               683	50	0.75	37.50	TRUE	FALSE
               104	50	0.75	37.50	TRUE	TRUE
               224	50	0.75	37.50	TRUE	FALSE
               334	50	0.75	37.50	TRUE	FALSE
               474	50	0.75	37.50	TRUE	FALSE
               684	50	0.75	37.50	TRUE	FALSE
               105	50	0.75	37.50	TRUE	FALSE
               225	50	0.75	37.50	TRUE	FALSE
               335	50	0.75	37.50	TRUE	FALSE
               475	50	0.75	37.50	TRUE	FALSE
               685	50	0.75	37.50	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title}uF capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '16'),\n")
   id += 1

inputData = '''1pF	100	2.00	200.00	TRUE	TRUE
               2.2pF	100	3.00	300.00	TRUE	FALSE
               3.3pF	100	3.00	300.00	TRUE	FALSE
               4.7pF	100	3.00	300.00	TRUE	FALSE
               6.8pF	100	3.00	300.00	TRUE	FALSE
               10pF	100	2.00	200.00	TRUE	TRUE
               22pF	100	2.00	200.00	TRUE	FALSE
               33pF	100	3.00	300.00	TRUE	FALSE
               47pF	100	2.00	200.00	TRUE	TRUE
               68pF	100	3.00	300.00	TRUE	FALSE
               100pF	100	2.00	200.00	TRUE	TRUE
               220pF	100	2.00	200.00	TRUE	TRUE
               330pF	100	2.00	200.00	TRUE	TRUE
               470pF	100	2.00	200.00	TRUE	TRUE
               680pF	100	3.00	300.00	TRUE	FALSE
               1nF	100	2.00	200.00	TRUE	TRUE
               2.2nF	100	2.00	200.00	TRUE	TRUE
               3.3nF	100	2.00	200.00	TRUE	TRUE
               4.7nF	100	3.00	300.00	TRUE	FALSE
               6.8nF	100	3.00	300.00	TRUE	FALSE
               10nF	100	2.00	200.00	TRUE	TRUE
               22nF	100	3.00	300.00	TRUE	FALSE
               33nF	100	2.00	200.00	TRUE	TRUE
               47nF	100	2.00	200.00	TRUE	TRUE
               68nF	100	3.00	300.00	TRUE	FALSE
               100nF	100	2.00	200.00	TRUE	TRUE
               220nF	100	2.25	225.00	TRUE	TRUE
               470nF	100	3.00	300.00	TRUE	TRUE
               680nF	100	3.00	300.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '17'),\n")
   id += 1

inputData = '''1pF	100	2.00	200.00	TRUE	TRUE
               2.2pF	100	3.00	300.00	TRUE	FALSE
               3.3pF	100	3.00	300.00	TRUE	FALSE
               4.7pF	100	3.00	300.00	TRUE	FALSE
               6.8pF	100	3.00	300.00	TRUE	FALSE
               10pF	100	2.00	200.00	TRUE	TRUE
               22pF	100	2.00	200.00	TRUE	FALSE
               33pF	100	3.00	300.00	TRUE	FALSE
               47pF	100	2.00	200.00	TRUE	TRUE
               68pF	100	3.00	300.00	TRUE	FALSE
               100pF	100	2.00	200.00	TRUE	TRUE
               220pF	100	2.00	200.00	TRUE	TRUE
               330pF	100	2.00	200.00	TRUE	TRUE
               470pF	100	2.00	200.00	TRUE	TRUE
               680pF	100	3.00	300.00	TRUE	FALSE
               1nF	100	2.00	200.00	TRUE	TRUE
               2.2nF	100	2.00	200.00	TRUE	TRUE
               3.3nF	100	2.00	200.00	TRUE	TRUE
               4.7nF	100	3.00	300.00	TRUE	FALSE
               6.8nF	100	3.00	300.00	TRUE	FALSE
               10nF	100	2.00	200.00	TRUE	TRUE
               22nF	100	3.00	300.00	TRUE	FALSE
               33nF	100	2.00	200.00	TRUE	TRUE
               47nF	100	2.00	200.00	TRUE	TRUE
               68nF	100	3.00	300.00	TRUE	FALSE
               100nF	100	2.00	200.00	TRUE	TRUE
               220nF	100	2.25	225.00	TRUE	TRUE
               470nF	100	3.00	300.00	TRUE	TRUE
               680nF	100	3.00	300.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '17'),\n")
   id += 1

inputData = '''1N4001	30	1.50	45.00	TRUE	TRUE
               1N4002	30	1.50	45.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = splitted[0]
   quantity = splitted[1]
   unit_price = splitted[2]
   is_in_lab = True if (splitted[5] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} diode', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '19'),\n")
   id += 1

inputData = '''Straight 40 pin male headers (Black)	30	12.00	360.00	TRUE	TRUE
               Straight 2x40 pin male headers (Black)	20	16.00	320.00	TRUE	FALSE
               Straight 40 pin male headers (Red)	10	16.00	160.00	TRUE	FALSE
               Straight 40 pin male headers (Yellow)	10	16.00	160.00	TRUE	FALSE
               Straight 40 pin male headers (Green)	10	16.00	160.00	TRUE	FALSE
               Female 40 pin headers	40	20.00	800.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} diode', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '22'),\n")
   id += 1

inputData = '''Red (5mm, Difussed) 	100	1.75	175.00	TRUE	TRUE
               Green (5mm, Difussed) 	100	2.00	200.00	TRUE	TRUE
               Blue (5mm, Difussed) 	100	2.00	200.00	TRUE	TRUE
               Yellow (5mm, Difussed) 	100	2.00	200.00	TRUE	TRUE
               White (5mm, Claen White) 	50	2.00	100.00	TRUE	TRUE
               Infrared LED (5mm) 	30	9.00	270.00	TRUE	FALSE
               Ultraviolet LED (5mm) 	30	12.00	360.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} LED', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '24'),\n")
   id += 1

inputData = '''White (meters)	25	25.00	625.00	TRUE	TRUE
               Blue (meters)	25	25.00	625.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} Single core wire', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '27'),\n")
   id += 1

inputData = '''7400	12	38.00	456.00	TRUE	TRUE
               7408	12	36.00	432.00	TRUE	TRUE
               7486	12	54.00	648.00	TRUE	FALSE
               7404	12	36.00	432.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} logic IC', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '31'),\n")
   id += 1

inputData = '''74138	6	22.00	132.00	TRUE	TRUE
               74139	6	36.00	216.00	TRUE	FALSE
               74157	6	72.00	432.00	TRUE	TRUE
               74244	6	60.00	360.00	TRUE	TRUE
               74245	4	54.00	216.00	TRUE	TRUE
               74273	3	42.00	126.00	TRUE	TRUE
               74283	4	174.00	696.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} IC', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '32'),\n")
   id += 1

inputData = '''NE555	7	15.00	105.00	TRUE	TRUE
               LM741	12	15.00	180.00	TRUE	TRUE
               L293	4	138.00	552.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} IC', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '33'),\n")
   id += 1

inputData = '''7805	10	24.00	240.00	TRUE	TRUE
               7806	10	20.00	200.00	TRUE	FALSE
               7812	10	28.00	280.00	TRUE	TRUE
               AMS 1117 3.3V	20	17.00	340.00	TRUE	FALSE
               AMS 1117 5V	20	12.00	240.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} Power regulator', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '34'),\n")
   id += 1


inputData = '''2N2222	20	4.00	80.00	TRUE	FALSE
               A733	20	9.00	180.00	TRUE	TRUE
               BC107	20	20.00	400.00	TRUE	FALSE
               BC556	20	3.00	60.00	TRUE	TRUE
               S8550	20	8.00	160.00	TRUE	FALSE
               S9012	20	2.50	50.00	TRUE	TRUE
               IRF520N	20	60.00	1,200.00	TRUE	TRUE
               IRF9530N	20	66.00	1,320.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} Transistor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '35'),\n")
   id += 1



inputData = '''4MHz	6	14.00	84.00	TRUE	TRUE
               8MHz	6	14.00	84.00	TRUE	FALSE
               12MHz	6	14.00	84.00	TRUE	TRUE
               16MHz	6	15.00	90.00	TRUE	FALSE
               20MHz	6	14.00	84.00	TRUE	FALSE
               32MHz	6	15.00	90.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} Crystal oscillators (2pins)', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '36'),\n")
   id += 1


inputData = '''3P	20	22.00	440.00	TRUE	TRUE
               4P	20	24.00	480.00	TRUE	TRUE
               5P	20	28.00	560.00	TRUE	TRUE
               6P	20	30.00	600.00	TRUE	TRUE
               8P	20	34.00	680.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} DIP switch', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '38'),\n")
   id += 1


inputData = '''USB Socket - A Type Female	15	18.00	270.00	TRUE	FALSE
               USB Socket - A Type Male	15	16.00	240.00	TRUE	FALSE
               DC Jack 2.1x5.5mm	20	18.00	360.00	TRUE	TRUE
               DC Barrel Socket 2.1x5.5mm	20	7.00	140.00	TRUE	FALSE
               Crocodile Clip - Red	25	19.00	475.00	TRUE	FALSE
               Crocodile Clip - Black	25	19.00	475.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split()
   title = " ".join(splitted[0:-5])
   quantity = splitted[-5]
   unit_price = splitted[-4]
   is_in_lab = True if (splitted[-1] == "TRUE") else False

   if not(is_in_lab):
       continue
   outputFile.write(f"        array('id' => '{id}', 'code' => '', 'title' => '{title} Port', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => 'comit1002.jpg', 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '39'),\n")
   id += 1






































outputFile.write("""
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $index => $setting) {
            $result = DB::table('consumable_items')->insert($setting);

            if (!$result) {
                $this->command->info("Insert failed at record $index.");
                return;
            }
        }

        $this->command->info('Inserted ' . count($this->data) . ' records to consumable_items table');
    }
}""")