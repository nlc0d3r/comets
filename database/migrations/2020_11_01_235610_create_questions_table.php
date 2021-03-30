<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sid')->constrained('surveys');
            $table->integer('order')->nullable();
            $table->string('code')->nullable();
            $table->string('question')->nullable();
        });

        DB::table('questions')->insert([
            ['sid' => '1', 'order' => '1', 'code' => 'REC_1', 'question' => 'Mans darba devējs pamana labi padarītu darbu?'],
            ['sid' => '1', 'order' => '2', 'code' => 'REC_2', 'question' => 'Darba devējs novērtē manus centienus?'],
            ['sid' => '1', 'order' => '3', 'code' => 'REC_3', 'question' => 'Pēdējo 7 dienu laikā esmu saņēmis atzinību vai uzslavas, kad esmu paveicis ko ārkārtēju?'],
            ['sid' => '1', 'order' => '4', 'code' => 'REC_4', 'question' => 'Es saņemu atbilstošu atzinību, kad esmu paveicis ko ārkārtēju?'],
            ['sid' => '1', 'order' => '5', 'code' => 'REC_5', 'question' => 'Pateicības un atzinības izteikšana manā organizācijā ir izplatīta?'],
            ['sid' => '1', 'order' => '6', 'code' => 'WRK_1', 'question' => 'Man patīk šāda veida darbs?'],
            ['sid' => '1', 'order' => '7', 'code' => 'WRK_2', 'question' => 'Mans darbs ir interesants?'],
            ['sid' => '1', 'order' => '8', 'code' => 'WRK_3', 'question' => 'Mans darbs dod man gandarījuma sajūtu par paveikto?'],
            ['sid' => '1', 'order' => '9', 'code' => 'WRK_4', 'question' => 'Mans ieguldījums uzņēmumā ir nozīmīgs?'],
            ['sid' => '1', 'order' => '10', 'code' => 'ADV_1', 'question' => 'Manā organizācijā pastāv paaugstināšanas vai izaugsmes iespējas?'],
            ['sid' => '1', 'order' => '11', 'code' => 'ADV_2', 'question' => 'Es zinu, kas man ir nepieciešams, lai virzītos uz priekšu organizācijā?'],
            ['sid' => '1', 'order' => '12', 'code' => 'ADV_3', 'question' => 'Iekšējie kandidāti saņem taisnīgu izskatīšanu atvērtajiem amatiem?'],
            ['sid' => '1', 'order' => '13', 'code' => 'ADV_4', 'question' => 'Informācija par brīvajām darba vakancēm organizācijā ir viegli pieejama?'],
            ['sid' => '1', 'order' => '14', 'code' => 'GTH_1', 'question' => 'Mana organizācija piedāvā apmācības vai izglītošanās iespējas, kas man nepieciešamas, lai augtu savā darbā?'],
            ['sid' => '1', 'order' => '15', 'code' => 'GTH_2', 'question' => 'Esmu saņēmis nepieciešamo apmācību, lai labi veiktu savu darbu?'],
            ['sid' => '1', 'order' => '16', 'code' => 'GTH_3', 'question' => 'Pēdējā gada laikā man ir bijušas iespējas darbā mācīties un augt?'],
            ['sid' => '1', 'order' => '17', 'code' => 'GTH_4', 'question' => 'Darbā ir kāds, kurš iedrošina manu attīstību?'],
            ['sid' => '1', 'order' => '18', 'code' => 'GTH_5', 'question' => 'Pēdējā gada laikā kāds ir runājis ar mani par manu progresu ?'],
            ['sid' => '1', 'order' => '19', 'code' => 'GFO_1', 'question' => 'Es izjūtu spēcīgu piederību organizācijai?'],
            ['sid' => '1', 'order' => '20', 'code' => 'GFO_2', 'question' => 'Man patīk runāt par organizāciju ar cilvēkiem, kuri šeit nestrādā?'],
            ['sid' => '1', 'order' => '21', 'code' => 'GFO_3', 'question' => 'Esmu cieši apņēmies darboties organizācijā?'],
            ['sid' => '1', 'order' => '22', 'code' => 'GFO_4', 'question' => 'Es lepojos, ka strādāju šajā organizācijā?'],
            ['sid' => '1', 'order' => '23', 'code' => 'GFO_5', 'question' => 'Man rūp organizācijas nākotne?'],
            ['sid' => '1', 'order' => '24', 'code' => 'MIS_1', 'question' => 'Es saprotu, kā mans darbs atbalsta uzņēmējdarbības misiju?'],
            ['sid' => '1', 'order' => '25', 'code' => 'MIS_2', 'question' => 'Es saprotu, kā mans darbs atbalsta organizācijas pakalpojumu sniegšanas misiju?'],
            ['sid' => '1', 'order' => '26', 'code' => 'MIS_3', 'question' => 'Es saprotu, kā mans darbs atbalsta manas nodaļas / nodaļas misiju?'],
            ['sid' => '1', 'order' => '27', 'code' => 'MIS_4', 'question' => 'Es zinu, ko no manis sagaida darbā?'],
            ['sid' => '1', 'order' => '28', 'code' => 'MIS_5', 'question' => 'Darbs tiek organizēts tā, lai katrs cilvēks varētu redzēt attiecības starp savu darbu un organizācijas mērķiem.?'],
            ['sid' => '1', 'order' => '29', 'code' => 'MIS_6', 'question' => 'Manas nodaļas mērķi man ir skaidri?'],
            ['sid' => '1', 'order' => '30', 'code' => 'SMG_1', 'question' => 'Augstākā vadība darbiniekus informē?'],
            ['sid' => '1', 'order' => '31', 'code' => 'SMG_2', 'question' => 'Augstākā vadība efektīvi paziņo mūsu organizācijas mērķus un stratēģijas?'],
            ['sid' => '1', 'order' => '32', 'code' => 'SMG_3', 'question' => 'Augstākā vadība demonstrē vadības praksi, kas atbilst mūsu organizācijas noteiktajām vērtībām?'],
            ['sid' => '1', 'order' => '33', 'code' => 'SPV_1', 'question' => 'Mans vadītājs labi komunicē?'],
            ['sid' => '1', 'order' => '34', 'code' => 'SPV_2', 'question' => 'Mans vadītājs efektīvi vada cilvēkus?'],
            ['sid' => '1', 'order' => '35', 'code' => 'SPV_3', 'question' => 'Mans vadītājs ir efektīvs lēmumu pieņēmējs?'],
            ['sid' => '1', 'order' => '36', 'code' => 'SPV_4', 'question' => 'Kopumā kā jūs vērtētu savu vadītāju?'],
            ['sid' => '1', 'order' => '37', 'code' => 'SPV_5', 'question' => 'Mans vadītājs izveido vidi, kas veicina uzticēšanos?'],
            ['sid' => '1', 'order' => '38', 'code' => 'SPV_6', 'question' => 'Mans vadītājs ir pretimnākošs un ar viņu ir viegli sarunāties?'],
            ['sid' => '1', 'order' => '39', 'code' => 'SPV_7', 'question' => 'Mans vadītājs rūpējas par mani kā par personu?'],
            ['sid' => '1', 'order' => '40', 'code' => 'SPV_8', 'question' => 'Mans vadītājs ikdienas darbā ir ētisks?'],
            ['sid' => '1', 'order' => '41', 'code' => 'SPV_9', 'question' => 'Mans vadītājs sniedz man konstruktīvas atsauksmes par manu sniegumu?'],
            ['sid' => '1', 'order' => '42', 'code' => 'SPV_10', 'question' => 'Mans vadītājs efektīvi tiek galā ar sliktu sniegumu?'],
            ['sid' => '1', 'order' => '43', 'code' => 'SPV_11', 'question' => 'Mans vadītājs pret mani izturas ar cieņu?'],
            ['sid' => '1', 'order' => '44', 'code' => '​​SPV_12', 'question' => 'Mans vadītājs pamana manu labi paveikto darbu?'],
            ['sid' => '1', 'order' => '45', 'code' => 'SPV_13', 'question' => 'Mans vadītājs apsver manas idejas?'],
            ['sid' => '1', 'order' => '46', 'code' => 'SPV_14', 'question' => 'Mans vadītājs man uzticas?'],
            ['sid' => '1', 'order' => '47', 'code' => 'SPV_15', 'question' => 'Manam vadītājam ir skaidrs priekšstats par to, kurp iet mūsu nodaļa un kā tur nokļūt?'],
            ['sid' => '1', 'order' => '48', 'code' => 'CWR_1', 'question' => 'Es uzticos saviem kolēģiem?'],
            ['sid' => '1', 'order' => '49', 'code' => 'CWR_2', 'question' => 'Mani kolēģi pastāvīgi izturas ar cieņu?'],
            ['sid' => '1', 'order' => '50', 'code' => 'CWR_3', 'question' => 'Es varu paļauties, ka mani kolēģi palīdzēs, kad tas būs nepieciešams?'],
            ['sid' => '1', 'order' => '51', 'code' => 'CWR_4', 'question' => 'Mēs un mani kolēģi strādājam kā daļa no komandas?'],
            ['sid' => '1', 'order' => '52', 'code' => 'CWR_5', 'question' => 'Manā organizācijā cilvēki rūpējas par otru?'],
            ['sid' => '1', 'order' => '53', 'code' => 'CWR_6', 'question' => 'Kāds manā nodaļā rūpējas par mani kā par personu?'],
            ['sid' => '1', 'order' => '54', 'code' => 'CWR_7', 'question' => 'Kad es pievienojos savai nodaļai, mani lika justies laipni gaidītam?'],
            ['sid' => '1', 'order' => '55', 'code' => 'CWR_8', 'question' => 'Mana darba grupa efektīvi sadarbojas ar citām darba grupām un departamentiem?'],
            ['sid' => '1', 'order' => '56', 'code' => 'SAL_1', 'question' => 'Mana darba samaksas likme ir konkurētspējīga, salīdzinot ar līdzīgiem darbiem citās organizācijās?'],
            ['sid' => '1', 'order' => '57', 'code' => 'SAL_2', 'question' => 'Man ir taisnīga samaksa par paveikto darbu?'],
            ['sid' => '1', 'order' => '58', 'code' => 'SAL_3', 'question' => 'Es saprotu, kā tiek noteikta mana pamatalga?'],
            ['sid' => '1', 'order' => '59', 'code' => 'SAL_4', 'question' => 'Mana alga / algas likme ir nozīmīgs faktors lēmumā palikt organizācijā?'],
            ['sid' => '1', 'order' => '60', 'code' => 'BEN_1', 'question' => 'Organizācijs piedāvātie bonusi atbilst manām vajadzībām?'],
            ['sid' => '1', 'order' => '61', 'code' => 'BEN_2', 'question' => 'Manas izmaksas, kas saistītas ar pabalstu plānu (līdzmaksājumi, atskaitījumi, prēmijas), ir pamatotas?'],
            ['sid' => '1', 'order' => '62', 'code' => 'BEN_3', 'question' => 'Bonusu pakete ir nozīmīgs faktors manā lēmumā palikt organizācijā?'],
            ['sid' => '1', 'order' => '63', 'code' => 'BEN_4', 'question' => 'Organizācijas bonusu pakete man ir pietiekami izskaidrota?'],
            ['sid' => '1', 'order' => '64', 'code' => 'VAL_1', 'question' => 'Uzņēmēmuma pamatvērtību ignorēšana radīs man nepatikšanas?'],
            ['sid' => '1', 'order' => '65', 'code' => 'VAL_2', 'question' => 'Ir skaidra un konsekventa vērtību kopa, kas nosaka uzņēmuma darbības veidu?'],
            ['sid' => '1', 'order' => '66', 'code' => 'VAL_3', 'question' => 'Visām uzņēmējdarbības un operāciju vienībām / departamentiem ir kopīgas vērtības?'],
            ['sid' => '1', 'order' => '67', 'code' => 'SAT_1', 'question' => 'Iedomājieties savu ideālo darbu. Cik labi jūsu pašreizējā pozīcija pielīdzināma šim ideālajam darbam?'],
            ['sid' => '1', 'order' => '68', 'code' => 'SAT_2', 'question' => 'Cik apmierināts esat ar savu pašreizējo darbu kopumā?'],
            ['sid' => '1', 'order' => '69', 'code' => 'SAT_3', 'question' => 'Apsveriet visas cerības, kādas jums bija, uzsākot pašreizējo darbu. Cik lielā mērā jūsu pašreizējais darbs atbilst vai pārsniedz šīs cerības?'],
            ['sid' => '1', 'order' => '70', 'code' => 'TRN_1', 'question' => 'Cik nopietni pēdējos mēnešos esat domājis par darba meklēšanu pie cita darba devēja?'],
            ['sid' => '1', 'order' => '71', 'code' => 'TRN_2', 'question' => 'Cik nopietni pēdējos mēnešos esat domājis par citas nozares darbu?'],
            ['sid' => '1', 'order' => '72', 'code' => 'TRN_3', 'question' => 'Cik nopietni pēdējo mēnešu laikā esat apsvēris darbu ārpus savas pašreizējās pilsētas?'],
            ['sid' => '1', 'order' => '73', 'code' => 'TRN_4', 'question' => 'Cik iespējams, ka nākamajā gadā jūs nopietni centīsities atrast citu darbu?'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
