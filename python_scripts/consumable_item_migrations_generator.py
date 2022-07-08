import os

# Note: Headers manually updated 

# Note: Please check whether the seeder file is updated by manual, before replace the automatically generated content
filename="./outputs/consumablesList.txt"
outputFile = open(filename,"w", encoding="utf-8")
os.makedirs(os.path.dirname(filename), exist_ok=True)

id = 1001

# Through Hole Resistors
inputData = '''10 Ω	100	0.50	50.00	TRUE	TRUE
               22 Ω	100	0.50	50.00	TRUE	TRUE
               47 Ω	100	0.50	50.00	TRUE	TRUE
               68 Ω	100	0.50	50.00	TRUE	TRUE
               100 Ω	100	0.50	50.00	TRUE	TRUE
               150 Ω	100	0.50	50.00	TRUE	TRUE
               220 Ω	100	0.50	50.00	TRUE	TRUE
               270 Ω	100	0.50	50.00	TRUE	TRUE
               330 Ω	100	0.50	50.00	TRUE	FALSE
               470 Ω	100	0.50	50.00	TRUE	TRUE
               510 Ω	100	0.50	50.00	TRUE	TRUE
               680 Ω	100	0.50	50.00	TRUE	TRUE
               1 kΩ	100	0.50	50.00	TRUE	TRUE
               2.2 kΩ	100	0.50	50.00	TRUE	TRUE
               3.3 kΩ	100	0.50	50.00	TRUE	TRUE
               4.7 kΩ	100	0.50	50.00	TRUE	TRUE
               5.1 kΩ	100	0.50	50.00	TRUE	TRUE
               6.8 kΩ	100	0.50	50.00	TRUE	TRUE
               10 kΩ	100	0.50	50.00	TRUE	TRUE
               22 kΩ	100	0.50	50.00	TRUE	FALSE
               33 kΩ	100	0.50	50.00	TRUE	TRUE
               47 kΩ	100	0.50	50.00	TRUE	TRUE
               51 kΩ	100	0.50	50.00	TRUE	TRUE
               68 kΩ	100	0.50	50.00	TRUE	TRUE
               100 kΩ	100	0.50	50.00	TRUE	TRUE
               220 kΩ	100	0.50	50.00	TRUE	TRUE
               330 kΩ	100	0.50	50.00	TRUE	TRUE
               470 kΩ	100	0.50	50.00	TRUE	TRUE
               510 kΩ	100	0.50	50.00	TRUE	TRUE
               680 kΩ	100	0.50	50.00	TRUE	TRUE
               1 MΩ	100	0.50	50.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Resistor', 'quantity' => '{quantity}', 'specifications' => '1/4 W', 'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '12'),\n")
   id += 1
outputFile.write('\n')

# SMD1206 Resistors
inputData = '''10 Ω	100	0.50	50.00	TRUE	TRUE
               22 Ω	100	0.50	50.00	TRUE	FALSE
               47 Ω	100	0.50	50.00	TRUE	FALSE
               68 Ω	100	0.50	50.00	TRUE	FALSE
               100 Ω	100	0.50	50.00	TRUE	TRUE
               150 Ω	100	0.50	50.00	TRUE	TRUE
               220 Ω	100	0.50	50.00	TRUE	TRUE
               270 Ω	100	0.50	50.00	TRUE	FALSE
               330 Ω	100	0.50	50.00	TRUE	TRUE
               470 Ω	100	0.50	50.00	TRUE	TRUE
               510 Ω	100	0.50	50.00	TRUE	FALSE
               680 Ω	100	0.50	50.00	TRUE	TRUE
               1KΩ	100	0.50	50.00	TRUE	FALSE
               2.2 kΩ	100	0.50	50.00	TRUE	TRUE
               3.3 kΩ	100	0.50	50.00	TRUE	TRUE
               4.7 kΩ	100	0.50	50.00	TRUE	TRUE
               5.1 kΩ	100	0.50	50.00	TRUE	FALSE
               6.8 kΩ	100	0.50	50.00	TRUE	TRUE
               10 kΩ	100	0.50	50.00	TRUE	FALSE
               22 kΩ	100	0.50	50.00	TRUE	TRUE
               33 kΩ	100	0.50	50.00	TRUE	TRUE
               47 kΩ	100	0.50	50.00	TRUE	TRUE
               51 kΩ	100	0.50	50.00	TRUE	FALSE
               68 kΩ	100	0.50	50.00	TRUE	TRUE
               100 kΩ	100	0.50	50.00	TRUE	TRUE
               220 kΩ	100	0.50	50.00	TRUE	TRUE
               330 kΩ	100	0.50	50.00	TRUE	TRUE
               470 kΩ	100	0.50	50.00	TRUE	TRUE
               510 kΩ	100	0.50	50.00	TRUE	TRUE
               680 kΩ	100	0.50	50.00	TRUE	TRUE
               1 MΩ	100	0.50	50.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Resistor', 'quantity' => '{quantity}', 'specifications' => '', 'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '13'),\n")
   id += 1

outputFile.write('\n')

# Electrolytic Capacitors
inputData = '''0.1 uF	50	1.50	75.00	TRUE	FALSE
               0.22 uF	50	1.50	75.00	TRUE	FALSE
               0.33 uF	50	1.50	75.00	TRUE	FALSE
               0.47 uF	50	1.50	75.00	TRUE	FALSE
               2.2 uF	50	1.50	75.00	TRUE	FALSE
               3.3 uF	50	2.00	100.00	TRUE	FALSE
               4.7 uF	50	2.00	100.00	TRUE	FALSE
               10 uF	50	1.50	75.00	TRUE	TRUE
               22 uF	50	1.50	75.00	TRUE	TRUE
               47 uF	50	1.50	75.00	TRUE	TRUE
               100 uF	50	3.00	150.00	TRUE	TRUE
               220 uF	50	3.50	175.00	TRUE	TRUE
               330 uF	50	3.00	150.00	TRUE	TRUE
               470 uF	50	3.50	175.00	TRUE	TRUE
               1000 uF	50	10.00	500.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Capacitor', 'quantity' => '{quantity}', 'specifications' => 'Through Hole',  'formFactor' => '', 'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '15'),\n")
   id += 1
outputFile.write('\n')

# Ceramic Capacitors
inputData = '''10 pF	50	0.75	37.50	TRUE	FALSE
               20 pF	50	0.75	37.50	TRUE	FALSE
               30 pF	50	0.75	37.50	TRUE	FALSE
               47 pF	50	0.75	37.50	TRUE	FALSE
               68 pF	50	0.75	37.50	TRUE	FALSE
               100 pF	50	0.75	37.50	TRUE	FALSE
               220 pF	50	0.75	37.50	TRUE	FALSE
               330 pF	50	0.75	37.50	TRUE	FALSE
               470 pF	50	0.75	37.50	TRUE	TRUE
               680 pF	50	0.75	37.50	TRUE	FALSE
               1 nF	50	0.75	37.50	TRUE	FALSE
               2.2 nF	50	0.75	37.50	TRUE	FALSE
               3.3 nF	50	0.75	37.50	TRUE	FALSE
               4.7 nF	50	0.75	37.50	TRUE	FALSE
               6.8 nF	50	0.75	37.50	TRUE	FALSE
               10 nF	50	0.75	37.50	TRUE	FALSE
               22 nF	50	0.75	37.50	TRUE	FALSE
               33 nF	50	0.75	37.50	TRUE	FALSE
               47 nF	50	0.75	37.50	TRUE	FALSE
               68 nF	50	0.75	37.50	TRUE	FALSE
               100 nF	50	0.75	37.50	TRUE	TRUE
               220 nF	50	0.75	37.50	TRUE	FALSE
               330 nF	50	0.75	37.50	TRUE	FALSE
               470 nF	50	0.75	37.50	TRUE	FALSE
               680 nF	50	0.75	37.50	TRUE	FALSE
               1 uF	50	0.75	37.50	TRUE	FALSE
               2.2 uF	50	0.75	37.50	TRUE	FALSE
               3.3 uF	50	0.75	37.50	TRUE	FALSE
               4.7 uF	50	0.75	37.50	TRUE	FALSE
               6.8 uF	50	0.75	37.50	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Capacitor', 'quantity' => '{quantity}', 'specifications' => 'Through Hole',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '16'),\n")
   id += 1
outputFile.write('\n')

inputData = '''1 pF	100	2.00	200.00	TRUE	TRUE
               2.2 pF	100	3.00	300.00	TRUE	FALSE
               3.3 pF	100	3.00	300.00	TRUE	FALSE
               4.7 pF	100	3.00	300.00	TRUE	FALSE
               6.8 pF	100	3.00	300.00	TRUE	FALSE
               10 pF	100	2.00	200.00	TRUE	TRUE
               22 pF	100	2.00	200.00	TRUE	FALSE
               33 pF	100	3.00	300.00	TRUE	FALSE
               47 pF	100	2.00	200.00	TRUE	TRUE
               68 pF	100	3.00	300.00	TRUE	FALSE
               100 pF	100	2.00	200.00	TRUE	TRUE
               220 pF	100	2.00	200.00	TRUE	TRUE
               330 pF	100	2.00	200.00	TRUE	TRUE
               470 pF	100	2.00	200.00	TRUE	TRUE
               680 pF	100	3.00	300.00	TRUE	FALSE
               1 nF	100	2.00	200.00	TRUE	TRUE
               2.2 nF	100	2.00	200.00	TRUE	TRUE
               3.3 nF	100	2.00	200.00	TRUE	TRUE
               4.7 nF	100	3.00	300.00	TRUE	FALSE
               6.8 nF	100	3.00	300.00	TRUE	FALSE
               10 nF	100	2.00	200.00	TRUE	TRUE
               22 nF	100	3.00	300.00	TRUE	FALSE
               33 nF	100	2.00	200.00	TRUE	TRUE
               47 nF	100	2.00	200.00	TRUE	TRUE
               68 nF	100	3.00	300.00	TRUE	FALSE
               100 nF	100	2.00	200.00	TRUE	TRUE
               220 nF	100	2.25	225.00	TRUE	TRUE
               470 nF	100	3.00	300.00	TRUE	TRUE
               680 nF	100	3.00	300.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '17'),\n")
   id += 1
outputFile.write('\n')

# SMD1206 Capacitors
inputData = '''1 pF	100	2.00	200.00	TRUE	TRUE
               2.2 pF	100	3.00	300.00	TRUE	FALSE
               3.3 pF	100	3.00	300.00	TRUE	FALSE
               4.7 pF	100	3.00	300.00	TRUE	FALSE
               6.8 pF	100	3.00	300.00	TRUE	FALSE
               10 pF	100	2.00	200.00	TRUE	TRUE
               22 pF	100	2.00	200.00	TRUE	FALSE
               33 pF	100	3.00	300.00	TRUE	FALSE
               47 pF	100	2.00	200.00	TRUE	TRUE
               68 pF	100	3.00	300.00	TRUE	FALSE
               100 pF	100	2.00	200.00	TRUE	TRUE
               220 pF	100	2.00	200.00	TRUE	TRUE
               330 pF	100	2.00	200.00	TRUE	TRUE
               470 pF	100	2.00	200.00	TRUE	TRUE
               680 pF	100	3.00	300.00	TRUE	FALSE
               1 nF	100	2.00	200.00	TRUE	TRUE
               2.2 nF	100	2.00	200.00	TRUE	TRUE
               3.3 nF	100	2.00	200.00	TRUE	TRUE
               4.7 nF	100	3.00	300.00	TRUE	FALSE
               6.8 nF	100	3.00	300.00	TRUE	FALSE
               10 nF	100	2.00	200.00	TRUE	TRUE
               22 nF	100	3.00	300.00	TRUE	FALSE
               33 nF	100	2.00	200.00	TRUE	TRUE
               47 nF	100	2.00	200.00	TRUE	TRUE
               68 nF	100	3.00	300.00	TRUE	FALSE
               100 nF	100	2.00	200.00	TRUE	TRUE
               220 nF	100	2.25	225.00	TRUE	TRUE
               470 nF	100	3.00	300.00	TRUE	TRUE
               680 nF	100	3.00	300.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Capacitor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '17'),\n")
   id += 1
outputFile.write('\n')

# Rectifier Diode
inputData = '''1N4001	30	1.50	45.00	TRUE	TRUE
               1N4002	30	1.50	45.00	TRUE	TRUE
               1N4003	30	3.00	90.00	TRUE	TRUE
               1N4005	30	3.00	90.00	TRUE	TRUE
               1N4007	30	3.00	90.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Rectifier Diode', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '19'),\n")
   id += 1
outputFile.write('\n')

# Zener Diodes
inputData = '''2V7	20	10.00	0	TRUE	TRUE
               3V3	20	10.00	0	TRUE	TRUE
               4V7	20	10.00	0	TRUE	TRUE
               5V1	20	10.00	0	TRUE	TRUE
               6V8	20	10.00	0	TRUE	TRUE
               8V2	20	10.00	0	TRUE	TRUE
               10V	20	10.00	0	TRUE	TRUE
               12V	20	10.00	0	TRUE	TRUE
               20V	20	10.00	0	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Zener Diode', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '1206',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '20'),\n")
   id += 1
outputFile.write('\n')

# Headers
inputData = '''Straight 40 pin Male (Black)	30	12.00	360.00	TRUE	TRUE
               Straight 2x40 pin Male (Black)	20	16.00	320.00	TRUE	FALSE
               Straight 40 pin Male (Red)	10	16.00	160.00	TRUE	FALSE
               Straight 40 pin Male (Yellow)	10	16.00	160.00	TRUE	FALSE
               Straight 40 pin Male (Green)	10	16.00	160.00	TRUE	FALSE
               Female 40 pin	40	20.00	800.00	TRUE	TRUE
               Female 2x40 pin	20	45.00	900.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title}', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '22'),\n")
   id += 1
outputFile.write('\n')

# LEDs
inputData = '''Red (5mm, Diffused) 	100	1.75	175.00	TRUE	TRUE
               Green (5mm, Diffused) 	100	2.00	200.00	TRUE	TRUE
               Blue (5mm, Diffused) 	100	2.00	200.00	TRUE	TRUE
               Yellow (5mm, Diffused) 	100	2.00	200.00	TRUE	TRUE
               White (5mm, Clean White) 	50	2.00	100.00	TRUE	TRUE
               Infrared (5mm) 	30	9.00	270.00	TRUE	FALSE
               Ultraviolet (5mm) 	30	12.00	360.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} LED', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '23'),\n")
   id += 1
outputFile.write('\n')

# Single Core Wire
inputData = '''Red	25	15.00	375.00	TRUE	TRUE
                Black	25	15.00	375.00	TRUE	TRUE
                Yellow	25	15.00	375.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('                ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Single Core Wire', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '27'),\n")
   id += 1
outputFile.write('\n')

# Circuit Wire
inputData = '''Red	1	10.00	1,000.00	TRUE	TRUE	TRUE
               Black	1	10.00	1,000.00	TRUE	TRUE	TRUE
               White	1	10.00	1,000.00	TRUE	TRUE	TRUE
               Green	1	10.00	1,000.00	TRUE	TRUE	TRUE
               Orange	1	10.00	1,000.00	TRUE	TRUE	TRUE
               Blue	1	10.00	1,000.00	TRUE	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Circuit Wire', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '29'),\n")
   id += 1
outputFile.write('\n')

# IC Base
inputData = '''10 pin	20	8.00	120.00	TRUE	FALSE
                12 pin	20	10.00	120.00	TRUE	FALSE
                14 pin	20	6.00	120.00	TRUE	TRUE
                16 pin	20	6.00	120.00	TRUE	TRUE
                18 pin	20	6.00	120.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('                ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} IC Base', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP, 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '25'),\n")
   id += 1
outputFile.write('\n')

# Logic ICs
inputData = '''7400	12	38.00	456.00	TRUE	TRUE
               7408	12	36.00	432.00	TRUE	TRUE
               7486	12	54.00	648.00	TRUE	FALSE
               7404	12	36.00	432.00	TRUE	FALSE
               7402	12	50.00	600.00	TRUE	FALSE
               7432	12	50.00	600.00	TRUE	FALSE
               7410	6	85.00	510.00	TRUE	FALSE
               7411	6	95.00	570.00	TRUE	FALSE
               7427	6	295.00	1,770.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Logic IC', 'quantity' => '{quantity}', 'specifications' => 'Logic ICs',  'formFactor' => 'DIP, 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '31'),\n")
   id += 1
outputFile.write('\n')

# 74xxx ICs
inputData = '''7447	6	120.00	720.00	TRUE	FALSE
                7491	2	580.00	1,160.00	TRUE	FALSE
                7476	3	365.00	1,095.00	TRUE	FALSE
                74138	4	22.00	132.00	TRUE	TRUE
                74139	6	36.00	216.00	TRUE	FALSE
                74157	6	72.00	432.00	TRUE	TRUE
                74244	6	60.00	360.00	TRUE	TRUE
                74245	4	54.00	216.00	TRUE	TRUE
                74273	3	42.00	126.00	TRUE	TRUE
                74283	4	174.00	696.00	TRUE	TRUE
                74173	3	360.00	1,080.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('                ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} IC', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP, 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '32'),\n")
   id += 1
outputFile.write('\n')

# Other ICs
inputData = '''NE555	7	15.00	105.00	TRUE	TRUE
               UA741	12	15.00	180.00	TRUE	TRUE
               L293	4	138.00	552.00	TRUE	FALSE
               LM324	12	30.00	360.00	TRUE	FALSE
               MAX232 	6	50.00	300.00	TRUE	FALSE
               ULN2003	10	45.00	450.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} IC', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP, 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '33'),\n")
   id += 1
outputFile.write('\n')

# Power Regulators
inputData = '''7805	10	24.00	240.00	TRUE	TRUE
               7806	10	20.00	200.00	TRUE	FALSE
               7812	10	28.00	280.00	TRUE	TRUE
               AMS 1117 3.3V	20	17.00	340.00	TRUE	FALSE
               AMS 1117 5V	20	12.00	240.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Power Regulator', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '34'),\n")
   id += 1

outputFile.write('\n')

# Transistors
inputData = '''2N2222	20	4.00	80.00	TRUE	FALSE
               C828	20	5.00	1000.00	TRUE	FALSE
               A733	20	9.00	180.00	TRUE	TRUE
               BC107	20	20.00	400.00	TRUE	FALSE
               BC556	20	3.00	60.00	TRUE	TRUE
               S8550	20	8.00	160.00	TRUE	FALSE
               S9012	20	2.50	50.00	TRUE	TRUE
               IRF520N	20	60.00	1,200.00	TRUE	TRUE
               IRF9530N	20	66.00	1,320.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Transistor', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'Through Hole',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '35'),\n")
   id += 1

outputFile.write('\n')

# Crystal Oscillators
inputData = '''4MHz	6	14.00	84.00	TRUE	TRUE
               8MHz	6	14.00	84.00	TRUE	FALSE
               12MHz	6	14.00	84.00	TRUE	TRUE
               16MHz	6	15.00	90.00	TRUE	FALSE
               20MHz	6	14.00	84.00	TRUE	FALSE
               32MHz	6	15.00	90.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Crystal Oscillator', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'Through Hole',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '36'),\n")
   id += 1
outputFile.write('\n')

# DIP Switches
inputData = '''3P	20	22.00	440.00	TRUE	TRUE
               4P	20	24.00	480.00	TRUE	TRUE
               5P	20	28.00	560.00	TRUE	TRUE
               6P	20	30.00	600.00	TRUE	TRUE
               8P	20	34.00	680.00	TRUE	TRUE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} DIP Switch', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => 'DIP, 0.1\"',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '38'),\n")
   id += 1

outputFile.write('\n')

# Ports
inputData = '''USB Socket - A Type Female	15	18.00	270.00	TRUE	FALSE
               USB Socket - A Type Male	15	16.00	240.00	TRUE	FALSE
               DC Jack 2.1x5.5mm	20	18.00	360.00	TRUE	TRUE
               DC Barrel Socket 2.1x5.5mm	20	7.00	140.00	TRUE	FALSE
               Crocodile Clip - Red	25	19.00	475.00	TRUE	FALSE
               Crocodile Clip - Black	25	19.00	475.00	TRUE	FALSE'''
for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('               ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Port', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '39'),\n")
   id += 1

outputFile.write('\n')

# Trimpots
inputData = '''500 Ω	15	15.00	225.00	TRUE	TRUE
                1 kΩ	15	15.00	225.00	TRUE	TRUE
                2 kΩ	15	15.00	225.00	TRUE	TRUE
                5 kΩ	15	15.00	225.00	TRUE	TRUE
                10 kΩ	15	15.00	225.00	TRUE	TRUE
                20 kΩ	15	15.00	225.00	TRUE	TRUE
                50 kΩ	15	15.00	225.00	TRUE	TRUE
                100 kΩ	15	15.00	225.00	TRUE	TRUE
                220 kΩ	15	15.00	225.00	TRUE	TRUE
                500 kΩ	15	15.00	225.00	TRUE	TRUE'''

for eachLine in inputData.split("\n"):
   splitted = eachLine.split('\t')
   title = splitted[0].replace('                ','')

   is_in_lab = True if (splitted[5] == "TRUE") else False
   if (is_in_lab):
       quantity = splitted[1]
   else:
       quantity = 0
   unit_price = splitted[2]

   outputFile.write(f"array('id' => '{id}', 'code' => '', 'title' => '{title} Trimpot', 'quantity' => '{quantity}', 'specifications' => '',  'formFactor' => '',  'datasheetURL' => '', 'price' => '{unit_price}', 'thumb' => NULL, 'created_at' => '2021-08-04 15:23:56', 'updated_at' => '2021-09-02 05:41:38', 'consumable_type_id' => '40'),\n")
   id += 1
