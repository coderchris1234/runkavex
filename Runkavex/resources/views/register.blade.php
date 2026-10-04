@extends('layouts.auth')
@section('content')

@php
$countries = [
"Afganistan"=>"Afghanistan","Albania"=>"Albania","Algeria"=>"Algeria","American Samoa"=>"American Samoa","Andorra"=>"Andorra","Angola"=>"Angola","Anguilla"=>"Anguilla","Antigua &amp; Barbuda"=>"Antigua &amp; Barbuda","Argentina"=>"Argentina","Armenia"=>"Armenia","Aruba"=>"Aruba","Australia"=>"Australia","Austria"=>"Austria","Azerbaijan"=>"Azerbaijan","Bahamas"=>"Bahamas","Bahrain"=>"Bahrain","Bangladesh"=>"Bangladesh","Barbados"=>"Barbados","Belarus"=>"Belarus","Belgium"=>"Belgium","Belize"=>"Belize","Benin"=>"Benin","Bermuda"=>"Bermuda","Bhutan"=>"Bhutan","Bolivia"=>"Bolivia","Bonaire"=>"Bonaire","Bosnia &amp; Herzegovina"=>"Bosnia &amp; Herzegovina","Botswana"=>"Botswana","Brazil"=>"Brazil","British Indian Ocean Ter"=>"British Indian Ocean Ter","Brunei"=>"Brunei","Bulgaria"=>"Bulgaria","Burkina Faso"=>"Burkina Faso","Burundi"=>"Burundi","Cambodia"=>"Cambodia","Cameroon"=>"Cameroon","Canada"=>"Canada","Canary Islands"=>"Canary Islands","Cape Verde"=>"Cape Verde","Cayman Islands"=>"Cayman Islands","Central African Republic"=>"Central African Republic","Chad"=>"Chad","Channel Islands"=>"Channel Islands","Chile"=>"Chile","China"=>"China","Christmas Island"=>"Christmas Island","Cocos Island"=>"Cocos Island","Colombia"=>"Colombia","Comoros"=>"Comoros","Congo"=>"Congo","Cook Islands"=>"Cook Islands","Costa Rica"=>"Costa Rica","Cote DIvoire"=>"Cote D&#039;Ivoire","Croatia"=>"Croatia","Cuba"=>"Cuba","Curaco"=>"Curacao","Cyprus"=>"Cyprus","Czech Republic"=>"Czech Republic","Denmark"=>"Denmark","Djibouti"=>"Djibouti","Dominica"=>"Dominica","Dominican Republic"=>"Dominican Republic","East Timor"=>"East Timor","Ecuador"=>"Ecuador","Egypt"=>"Egypt","El Salvador"=>"El Salvador","Equatorial Guinea"=>"Equatorial Guinea","Eritrea"=>"Eritrea","Estonia"=>"Estonia","Ethiopia"=>"Ethiopia","Falkland Islands"=>"Falkland Islands","Faroe Islands"=>"Faroe Islands","Fiji"=>"Fiji","Finland"=>"Finland","France"=>"France","French Guiana"=>"French Guiana","French Polynesia"=>"French Polynesia","French Southern Ter"=>"French Southern Ter","Gabon"=>"Gabon","Gambia"=>"Gambia","Georgia"=>"Georgia","Germany"=>"Germany","Ghana"=>"Ghana","Gibraltar"=>"Gibraltar","Great Britain"=>"Great Britain","Greece"=>"Greece","Greenland"=>"Greenland","Grenada"=>"Grenada","Guadeloupe"=>"Guadeloupe","Guam"=>"Guam","Guatemala"=>"Guatemala","Guinea"=>"Guinea","Guyana"=>"Guyana","Haiti"=>"Haiti","Hawaii"=>"Hawaii","Honduras"=>"Honduras","Hong Kong"=>"Hong Kong","Hungary"=>"Hungary","Iceland"=>"Iceland","India"=>"India","Indonesia"=>"Indonesia","Iran"=>"Iran","Iraq"=>"Iraq","Ireland"=>"Ireland","Isle of Man"=>"Isle of Man","Israel"=>"Israel","Italy"=>"Italy","Jamaica"=>"Jamaica","Japan"=>"Japan","Jordan"=>"Jordan","Kazakhstan"=>"Kazakhstan","Kenya"=>"Kenya","Kiribati"=>"Kiribati","Korea North"=>"Korea North","Korea Sout"=>"Korea South","Kuwait"=>"Kuwait","Kyrgyzstan"=>"Kyrgyzstan","Laos"=>"Laos","Latvia"=>"Latvia","Lebanon"=>"Lebanon","Lesotho"=>"Lesotho","Liberia"=>"Liberia","Libya"=>"Libya","Liechtenstein"=>"Liechtenstein","Lithuania"=>"Lithuania","Luxembourg"=>"Luxembourg","Macau"=>"Macau","Macedonia"=>"Macedonia","Madagascar"=>"Madagascar","Malaysia"=>"Malaysia","Malawi"=>"Malawi","Maldives"=>"Maldives","Mali"=>"Mali","Malta"=>"Malta","Marshall Islands"=>"Marshall Islands","Martinique"=>"Martinique","Mauritania"=>"Mauritania","Mauritius"=>"Mauritius","Mayotte"=>"Mayotte","Mexico"=>"Mexico","Midway Islands"=>"Midway Islands","Moldova"=>"Moldova","Monaco"=>"Monaco","Mongolia"=>"Mongolia","Montserrat"=>"Montserrat","Morocco"=>"Morocco","Mozambique"=>"Mozambique","Myanmar"=>"Myanmar","Nambia"=>"Nambia","Nauru"=>"Nauru","Nepal"=>"Nepal","Netherland Antilles"=>"Netherland Antilles","Netherlands"=>"Netherlands (Holland, Europe)","Nevis"=>"Nevis","New Caledonia"=>"New Caledonia","New Zealand"=>"New Zealand","Nicaragua"=>"Nicaragua","Niger"=>"Niger","Nigeria"=>"Nigeria","Niue"=>"Niue","Norfolk Island"=>"Norfolk Island","Norway"=>"Norway","Oman"=>"Oman","Pakistan"=>"Pakistan","Palau Island"=>"Palau Island","Palestine"=>"Palestine","Panama"=>"Panama","Papua New Guinea"=>"Papua New Guinea","Paraguay"=>"Paraguay","Peru"=>"Peru","Phillipines"=>"Philippines","Pitcairn Island"=>"Pitcairn Island","Poland"=>"Poland","Portugal"=>"Portugal","Puerto Rico"=>"Puerto Rico","Qatar"=>"Qatar","Republic of Montenegro"=>"Republic of Montenegro","Republic of Serbia"=>"Republic of Serbia","Reunion"=>"Reunion","Romania"=>"Romania","Russia"=>"Russia","Rwanda"=>"Rwanda","St Barthelemy"=>"St Barthelemy","St Eustatius"=>"St Eustatius","St Helena"=>"St Helena","St Kitts-Nevis"=>"St Kitts-Nevis","St Lucia"=>"St Lucia","St Maarten"=>"St Maarten","St Pierre &amp; Miquelon"=>"St Pierre &amp; Miquelon","St Vincent &amp; Grenadines"=>"St Vincent &amp; Grenadines","Saipan"=>"Saipan","Samoa"=>"Samoa","Samoa American"=>"Samoa American","San Marino"=>"San Marino","Sao Tome &amp; Principe"=>"Sao Tome &amp; Principe","Saudi Arabia"=>"Saudi Arabia","Senegal"=>"Senegal","Serbia"=>"Serbia","Seychelles"=>"Seychelles","Sierra Leone"=>"Sierra Leone","Singapore"=>"Singapore","Slovakia"=>"Slovakia","Slovenia"=>"Slovenia","Solomon Islands"=>"Solomon Islands","Somalia"=>"Somalia","South Africa"=>"South Africa","Spain"=>"Spain","Sri Lanka"=>"Sri Lanka","Sudan"=>"Sudan","Suriname"=>"Suriname","Swaziland"=>"Swaziland","Sweden"=>"Sweden","Switzerland"=>"Switzerland","Syria"=>"Syria","Tahiti"=>"Tahiti","Taiwan"=>"Taiwan","Tajikistan"=>"Tajikistan","Tanzania"=>"Tanzania","Thailand"=>"Thailand","Togo"=>"Togo","Tokelau"=>"Tokelau","Tonga"=>"Tonga","Trinidad &amp; Tobago"=>"Trinidad &amp; Tobago","Tunisia"=>"Tunisia","Turkey"=>"Turkey","Turkmenistan"=>"Turkmenistan","Turks &amp; Caicos Is"=>"Turks &amp; Caicos Is","Tuvalu"=>"Tuvalu","Uganda"=>"Uganda","Ukraine"=>"Ukraine","United Arab Erimates"=>"United Arab Emirates","United Kingdom"=>"United Kingdom","United States of America"=>"United States of America","Uraguay"=>"Uruguay","Uzbekistan"=>"Uzbekistan","Vanuatu"=>"Vanuatu","Vatican City State"=>"Vatican City State","Venezuela"=>"Venezuela","Vietnam"=>"Vietnam","Virgin Islands (Brit)"=>"Virgin Islands (Brit)","Virgin Islands (USA)"=>"Virgin Islands (USA)","Wake Island"=>"Wake Island","Wallis &amp; Futana Is"=>"Wallis &amp; Futana Is","Yemen"=>"Yemen","Zaire"=>"Zaire","Zambia"=>"Zambia","Zimbabwe"=>"Zimbabwe",
];
@endphp

<div class="w-full max-w-2xl mx-auto">

    <div class="text-center mb-8">
        <a href="{{ url('/') }}">
            <img src="{{ asset('brand/logo.png') }}" alt="Runkavex Capital" class="h-12 mx-auto">
        </a>
    </div>

    <div class="bg-surface-raised border border-surface-border rounded-xl p-8">

        <h1 class="text-2xl font-bold text-content-primary mb-1">Sign Up for Free</h1>
        <p class="text-content-tertiary text-sm mb-6">It's free to sign up and only takes a minute.</p>

        <form method="POST" action="{{ url('/register') }}">
            @csrf

            @if($errors->any())
            <div class="mb-5 p-3 rounded-lg bg-loss/10 border border-loss/20 text-loss text-xs">
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        placeholder="Enter your Name"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        placeholder="Enter Preferred Username"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        placeholder="Enter your email"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required maxlength="13"
                        placeholder="Enter your phone"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Gender</label>
                    <select name="gender" required
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        <option value="" class="text-content-tertiary">Select Gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="other">Others</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Country</label>
                    <select name="country" required
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                        @foreach($countries as $val => $label)
                        <option value="{{ $val }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Preferred Currency</label>
                <select name="currency_code" required
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    @foreach([
                        'AED'=>"AED (د.إ) — UAE Dirham",'AFN'=>"AFN (Af) — Afghan Afghani",'ALL'=>"ALL (Lek) — Albanian Lek",'ANG'=>"ANG (ƒ) — Netherlands Antillean Guilder",'AOA'=>"AOA (Kz) — Angolan Kwanza",'ARS'=>"ARS ($) — Argentine Peso",'AUD'=>"AUD ($) — Australian Dollar",'AWG'=>"AWG (ƒ) — Aruban Florin",'AZN'=>"AZN (ман) — Azerbaijani Manat",'BAM'=>"BAM (KM) — Bosnia-Herzegovina Mark",'BBD'=>"BBD ($) — Barbadian Dollar",'BDT'=>"BDT (৳) — Bangladeshi Taka",'BGN'=>"BGN (лв) — Bulgarian Lev",'BHD'=>"BHD (.د.ب) — Bahraini Dinar",'BIF'=>"BIF (FBu) — Burundian Franc",'BMD'=>"BMD ($) — Bermudian Dollar",'BND'=>"BND ($) — Brunei Dollar",'BOB'=>"BOB (\$b) — Bolivian Boliviano",'BRL'=>"BRL (R$) — Brazilian Real",'BSD'=>"BSD ($) — Bahamian Dollar",'BTN'=>"BTN (Nu.) — Bhutanese Ngultrum",'BWP'=>"BWP (P) — Botswanan Pula",'BYR'=>"BYR (p.) — Belarusian Ruble",'BZD'=>"BZD (BZ$) — Belize Dollar",'CAD'=>"CAD ($) — Canadian Dollar",'CDF'=>"CDF (FC) — Congolese Franc",'CHF'=>"CHF (CHF) — Swiss Franc",'CLP'=>"CLP ($) — Chilean Peso",'CNY'=>"CNY (¥) — Chinese Yuan",'COP'=>"COP ($) — Colombian Peso",'CRC'=>"CRC (₡) — Costa Rican Colón",'CUP'=>"CUP (⃌) — Cuban Peso",'CVE'=>"CVE ($) — Cape Verdean Escudo",'CZK'=>"CZK (Kč) — Czech Koruna",'DJF'=>"DJF (Fdj) — Djiboutian Franc",'DKK'=>"DKK (kr) — Danish Krone",'DOP'=>"DOP (RD$) — Dominican Peso",'DZD'=>"DZD (دج) — Algerian Dinar",'EGP'=>"EGP (£) — Egyptian Pound",'ETB'=>"ETB (Br) — Ethiopian Birr",'EUR'=>"EUR (€) — Euro",'FJD'=>"FJD ($) — Fijian Dollar",'FKP'=>"FKP (£) — Falkland Islands Pound",'GBP'=>"GBP (£) — British Pound Sterling",'GEL'=>"GEL (ლ) — Georgian Lari",'GHS'=>"GHS (¢) — Ghanaian Cedi",'GIP'=>"GIP (£) — Gibraltar Pound",'GMD'=>"GMD (D) — Gambian Dalasi",'GNF'=>"GNF (FG) — Guinean Franc",'GTQ'=>"GTQ (Q) — Guatemalan Quetzal",'GYD'=>"GYD ($) — Guyanaese Dollar",'HKD'=>"HKD ($) — Hong Kong Dollar",'HNL'=>"HNL (L) — Honduran Lempira",'HRK'=>"HRK (kn) — Croatian Kuna",'HTG'=>"HTG (G) — Haitian Gourde",'HUF'=>"HUF (Ft) — Hungarian Forint",'IDR'=>"IDR (Rp) — Indonesian Rupiah",'ILS'=>"ILS (₪) — Israeli New Sheqel",'INR'=>"INR (₹) — Indian Rupee",'IQD'=>"IQD (ع.د) — Iraqi Dinar",'IRR'=>"IRR (﷼) — Iranian Rial",'ISK'=>"ISK (kr) — Icelandic Króna",'JEP'=>"JEP (£) — Jersey Pound",'JMD'=>"JMD (J$) — Jamaican Dollar",'JOD'=>"JOD (JD) — Jordanian Dinar",'JPY'=>"JPY (¥) — Japanese Yen",'KES'=>"KES (KSh) — Kenyan Shilling",'KGS'=>"KGS (лв) — Kyrgystani Som",'KHR'=>"KHR (៛) — Cambodian Riel",'KMF'=>"KMF (CF) — Comorian Franc",'KPW'=>"KPW (₩) — North Korean Won",'KRW'=>"KRW (₩) — South Korean Won",'KWD'=>"KWD (د.ك) — Kuwaiti Dinar",'KYD'=>"KYD ($) — Cayman Islands Dollar",'KZT'=>"KZT (лв) — Kazakhstani Tenge",'LAK'=>"LAK (₭) — Laotian Kip",'LBP'=>"LBP (£) — Lebanese Pound",'LKR'=>"LKR (₨) — Sri Lankan Rupee",'LRD'=>"LRD ($) — Liberian Dollar",'LSL'=>"LSL (L) — Lesotho Loti",'LTL'=>"LTL (Lt) — Lithuanian Litas",'LVL'=>"LVL (Ls) — Latvian Lats",'LYD'=>"LYD (ل.د) — Libyan Dinar",'MAD'=>"MAD (د.م.) — Moroccan Dirham",'MDL'=>"MDL (L) — Moldovan Leu",'MGA'=>"MGA (Ar) — Malagasy Ariary",'MKD'=>"MKD (ден) — Macedonian Denar",'MMK'=>"MMK (K) — Myanma Kyat",'MNT'=>"MNT (₮) — Mongolian Tugrik",'MOP'=>"MOP (MOP$) — Macanese Pataca",'MRO'=>"MRO (UM) — Mauritanian Ouguiya",'MUR'=>"MUR (₨) — Mauritian Rupee",'MVR'=>"MVR (.ރ) — Maldivian Rufiyaa",'MWK'=>"MWK (MK) — Malawian Kwacha",'MXN'=>"MXN ($) — Mexican Peso",'MYR'=>"MYR (RM) — Malaysian Ringgit",'MZN'=>"MZN (MT) — Mozambican Metical",'NAD'=>"NAD ($) — Namibian Dollar",'NGN'=>"NGN (₦) — Nigerian Naira",'NIO'=>"NIO (C$) — Nicaraguan Córdoba",'NOK'=>"NOK (kr) — Norwegian Krone",'NPR'=>"NPR (₨) — Nepalese Rupee",'NZD'=>"NZD ($) — New Zealand Dollar",'OMR'=>"OMR (﷼) — Omani Rial",'PAB'=>"PAB (B/.) — Panamanian Balboa",'PEN'=>"PEN (S/.) — Peruvian Sol",'PGK'=>"PGK (K) — Papua New Guinean Kina",'PHP'=>"PHP (₱) — Philippine Peso",'PKR'=>"PKR (₨) — Pakistani Rupee",'PLN'=>"PLN (zł) — Polish Zloty",'PYG'=>"PYG (Gs) — Paraguayan Guarani",'QAR'=>"QAR (﷼) — Qatari Rial",'RON'=>"RON (lei) — Romanian Leu",'RSD'=>"RSD (Дин.) — Serbian Dinar",'RUB'=>"RUB (руб) — Russian Ruble",'RWF'=>"RWF (ر.س) — Rwandan Franc",'SAR'=>"SAR (﷼) — Saudi Riyal",'SBD'=>"SBD ($) — Solomon Islands Dollar",'SCR'=>"SCR (₨) — Seychellois Rupee",'SDG'=>"SDG (£) — Sudanese Pound",'SEK'=>"SEK (kr) — Swedish Krona",'SGD'=>"SGD ($) — Singapore Dollar",'SHP'=>"SHP (£) — Saint Helena Pound",'SLL'=>"SLL (Le) — Sierra Leonean Leone",'SOS'=>"SOS (S) — Somali Shilling",'SRD'=>"SRD ($) — Surinamese Dollar",'STD'=>"STD (Db) — São Tomé and Príncipe Dobra",'SVC'=>"SVC ($) — Salvadoran Colón",'SYP'=>"SYP (£) — Syrian Pound",'SZL'=>"SZL (L) — Swazi Lilangeni",'THB'=>"THB (฿) — Thai Baht",'TJS'=>"TJS (TJS) — Tajikistani Somoni",'TMT'=>"TMT (m) — Turkmenistani Manat",'TND'=>"TND (د.ت) — Tunisian Dinar",'TOP'=>"TOP (T$) — Tongan Pa&#039;anga",'TRY'=>"TRY (₤) — Turkish Lira",'TTD'=>"TTD ($) — Trinidad and Tobago Dollar",'TWD'=>"TWD (NT$) — New Taiwan Dollar",'UAH'=>"UAH (₴) — Ukrainian Hryvnia",'UGX'=>"UGX (USh) — Ugandan Shilling",'USD'=>"USD ($) — US Dollar",'UYU'=>"UYU (\$U) — Uruguayan Peso",'UZS'=>"UZS (лв) — Uzbekistan Som",'VEF'=>"VEF (Bs) — Venezuelan Bolívar",'VND'=>"VND (₫) — Vietnamese Dong",'VUV'=>"VUV (VT) — Vanuatu Vatu",'WST'=>"WST (WS$) — Samoan Tala",'XAF'=>"XAF (FCFA) — CFA Franc BEAC",'XCD'=>"XCD ($) — East Caribbean Dollar",'XPF'=>"XPF (F) — CFP Franc",'YER'=>"YER (﷼) — Yemeni Rial",'ZAR'=>"ZAR (R) — South African Rand",'ZMK'=>"ZMK (ZK) — Zambian Kwacha",'ZWL'=>"ZWL (Z$) — Zimbabwean Dollar",
                    ] as $code => $label)
                    <option value="{{ $code }}" style="background:#1a1d23;color:#e5e7eb" {{ $code === 'USD' ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-content-tertiary">All balances and amounts will be displayed in this currency</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Referral Code <span class="text-content-tertiary font-normal">(optional)</span></label>
                <input type="text" name="referral_code" value="{{ old('referral_code') }}"
                    placeholder="Enter referral code if you have one"
                    class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Password</label>
                    <input type="password" name="password" required autocomplete="new-password"
                        placeholder="Enter your password"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
                <div>
                    <label class="block text-sm font-medium text-content-secondary mb-1.5">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        placeholder="Confirm Password"
                        class="w-full bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-content-secondary mb-1.5">Security Check</label>
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-sm font-medium text-content-primary select-none whitespace-nowrap">
                        5 + 6 =
                    </div>
                    <input type="text" name="captcha" required inputmode="numeric"
                        placeholder="Answer"
                        class="w-24 bg-surface-overlay border border-surface-border rounded-lg px-4 py-2.5 text-content-primary placeholder-content-tertiary focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors text-center">
                </div>
                <input type="hidden" name="captcha_confirmation" value="11">
            </div>

            <div hidden class="mb-6" x-data="{ selected: [] }">
                @php $accountTypes = ['Binary Option Trading' => 'Binary Options', 'Forex Trading' => 'Forex', 'Stock Trading' => 'Stocks', 'CryptoCurrency Investment' => 'Crypto', 'NFT Trading' => 'NFTs']; @endphp
                @foreach($accountTypes as $val => $label)
                <label><input type="checkbox" name="account[]" value="{{ $val }}" checked class="mr-1">{{ $label }}</label>
                @endforeach
            </div>

            <button type="submit"
                class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-2.5 rounded-lg transition-colors">
                Register
            </button>
        </form>

        <div class="mt-6 text-sm text-content-tertiary">
            Already have an account? <a href="{{ url('/login') }}" class="text-primary-light hover:text-primary transition-colors">Sign In</a>
        </div>
    </div>
</div>

@endsection
