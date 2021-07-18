<?php 

//Luokka johon voidaan varastoida tilinumeroita koskevat tiedot
class AccountFormat {
        public $BIC="";
        public $MLen=6;
        function AccountFormat($BIC,$MLen=6) {
                $this->BIC = $BIC;
                $this->MLen = $MLen;
        }
}

//Varsinainen laskinluokka
class IBANCalculator {
        public $BBAN;
        public $IBAN;
        public $BIC;
        public $Error;
        private $af;
       
        function __construct() {
                //M��ritell��n suomessa k�yt�ss� olevien tilinumeroiden tiedot
                $this->af['1'] = new AccountFormat('NDEAFIHH');
                $this->af['2'] = $this->af['1'];
                $this->af['31'] = new AccountFormat('HANDFIHH');
                $this->af['33'] = new AccountFormat('ESSEFIHX');
                $this->af['34'] = new AccountFormat('DABAFIHX');
                $this->af['36'] = new AccountFormat('TAPIFI22');
                $this->af['37'] = new AccountFormat('DNBAFIHX');
                $this->af['38'] = new AccountFormat('SWEDFIHH');
                $this->af['39'] = new AccountFormat('SBANFIHH');
                $this->af['4'] = new AccountFormat('HELSFIHH',7);
                $this->af['5'] = new AccountFormat('OKOYFIHH',7);
                $this->af['6'] = new AccountFormat('AABAFI22');
                $this->af['8'] = new AccountFormat('DABAFIHH');
        }
       
        function Calculate($BBAN) {
                //Laskentafunktio. Palauttaa true on laskenta onnistuu, false muuten

                //Annettu arvo luokan muuttujaan
                if (stristr($BBAN,"FI")) {
        	    $BBAN = substr($BBAN, 4);
                } else {
                $BBAN = $BBAN;
                }
                $this->BBAN	= $BBAN;
                //Oletuksena tilinumero v��rin, jos tarkiste my�hemmin t�sm�� niin sitten muutetaan
                $ok = false;
                //J�tet��n pelk�t numerot (v�lit ja v�liviivat pois sotkemasta)
                $tilicleaned =  preg_replace('/\D+/', '', $BBAN);
                //Pelkkien numeroiden pituus
                $tclen = strlen($tilicleaned);
                //Tilinumero voi olla validi jos se on ilman t�ytenollia 8-14 merkki� pitk�.
                if ($tclen>7 && $tclen<15) {
                        //Muuttuja johon tilimuotoilu tulee
                        $fm = null;
                        if (isset($this->af[$tilicleaned{0}]))
                        {
                                //Jos tilin ekan numeron perusteella l�ytyy muotoilu, otetaan se
                                $fm = $this->af[$tilicleaned{0}];
                        }
                        elseif (isset($this->af[substr($tilicleaned,0,2)]))
                        {
                                //Ent� 2 ekan numeron perusteella
                                $fm = $this->af[substr($tilicleaned,0,2)];
                        }
                        if ($fm !== null) {
                                //Jos muotoilu l�ytyi, lis�t��n v�linollat.
                                if ($tclen<14) {
                                        $tilicleaned = substr($tilicleaned, 0, $fm->MLen) . substr('00000000',0,14-$tclen) . substr($tilicleaned, $fm->MLen);
                                }
                                //Lasketaan tarkistesumma
                                $sum = 0;
                                for ($i=0; $i<14; $i++) {
                                        $a = $tilicleaned{$i};
                                        if (($i & 1) == 0) {
                                                $a*=2;
                                                if ($a>9) $a-=9;
                                        }
                                        $sum+=$a;
                                }
                                //Jos tarkistesumma on 10 jaollinen, niin tilinumero on OK
                                if (($sum % 10) == 0) $ok = true;
                        }
                }

                if ($ok) {
                        //Jos tilinumero oli ok, niin konekielinen tilinumero on muuttujassa $tilicleaned
                        //Lasketaan sen perusteella IBAN. Lasketaan osissa koska PHP ei osaa laskea 20 merkki� pitk�n numeron jakoj��nn�st� suoraan.
                        $IBANTN = ((substr($tilicleaned,0,7) % 97) . substr($tilicleaned,7)) % 97;
                        $IBANTN = 198 - (($IBANTN . '151800') % 97);
                        $IBAN = 'FI'.substr($IBANTN,1,2).$tilicleaned;

                        unset($this->Error);
                        //Lis�t��n v�lit nelj�n merkin v�lein
                        $this->IBAN = implode(' ',str_split($IBAN,4));
                        //Tilinumeron muotoiluluokasta BIC-koodi
                        $this->BIC = $fm->BIC;
                } else {
                        //Tilinumero oli virheellinen
                        $this->Error = 'Virheellinen tilinumero';
                        unset($this->IBAN);
                        unset($this->BIC);
                }
                return $ok;
        }
}