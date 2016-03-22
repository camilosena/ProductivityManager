<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact Us</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main_responsive.css">
	<link rel="stylesheet" type="text/css" href="css/stylesNavTop.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<script type="text/javascript" src="js/script2.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/carouFredSel.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" href="css/animate.css">
</head>
<body>
	<div id='cssmenu' style="text-align:center">        
		<ul>
			<li><a href='indexEnglish.php'><span><i class="fa fa-home fa-lg"></i>  </span></a></li>
			<li><a href='ourClients.html'><span><i class="fa fa-users fa-lg"></i>  </span></a></li>
			<li><a href='contactUs'><span><i class="fa fa-envelope-o fa-lg"></i>  </span></a></li>
		</ul>       
	</div> 
	<style type="text/css">
		header nav{
			overflow: hidden;
			display: inline-block;
			margin: 20px 0 0 40px;
			padding: 30px 40px;
			border-left: 1px #000 solid;
			z-index: 9999;
			height: 80px;
		}
		header nav ul{
			list-style: none;
		}

		header nav ul li{
			float: left;
			margin-left: 20px;
			font-size: 12px;
			font-family: 'lato_regular', arial;
			letter-spacing: 1px;
		}

		header nav ul li:first-child{
			margin-left: 0;
		}

		header nav ul li a {
			text-decoration: none; 
			font-weight: bold;   
			color: #000;    
		}

		header nav ul li a:hover{
			color: #83AF44;
		}

		header nav ul li a:active{
			text-decoration: underline;
		}
	</style>
	<header>
		<div class="wrapper">
			<a href="indexEnglish.php"><img src="img/logo.png" class="logo animated slideInLeft" width="190px" height="110px"></a>
			<a href="#" class="menu_icon" id="menu_icon"></a>
			<nav id="nav_menu" class="animated slideInDown">
				<ul>
					<li><a href="indexEnglish.php">Home</a></li>					
					<li><a href="ourClients.html">Our Clients</a></li>
					<li><a href="contactUs">Contact Us</a></li>
				</ul>
			</nav>
			<ul class="social animated slideInRight">
				<li><a class="fb" href="https://www.facebook.com/productivitymanager"></a></li>
				<li><a class="twitter" href="https://twitter.com/Productivity_Mg"></a></li>
				<li><a class="gplus" href="mailto:productivitymanagersoftware@gmail.com"></a></li>
			</ul>
		</div>
	</header>
	<div id="panelIzq2" class="animated zoomIn">
		<div class="caption">		
			<h2 class="h330">Contact us:</h2><br>			
			<form class="formRegistro" method="post" action="#">					    	
				<label class="tag" for="txtName"><span id="lab_valName" class="h331">Name </span></label>
				<input class="input" name="txtName" type="text" maxlength="64" id="txtName" class="field1" autofocus required pattern= "[A-Za-z]{3,20}">
				<span id="valName" style="color:Red;visibility:hidden;"></span>
				<br>
				<label class="tag" for="txtSurname"><span id="lab_valSurname" class="h331">Surname </span></label>
				<input class="input" name="txtSurname" type="text" maxlength="64" id="txtSurname" class="field1" required pattern= "[A-Za-z]{3,20}">
				<span id="valSurname" style="color:Red;visibility:hidden;"></span>
				<br>
				<label class="tag" for="txtCompany"><span id="lab_valCompany" class="h331">Company </span></label>
				<input class="input" name="txtCompany" type="text" maxlength="64" id="txtCompany" class="field1" required pattern= "[A-Za-z]{3,40}">
				<span id="valCompany" style="color:Red;visibility:hidden;"></span>
				<br>
				<label class="tag" for="txtEmail"><span id="lab_valEmail" class="h331">Email </span></label>
				<input class="input" name="txtEmail" type="text" maxlength="128" id="txtEmail" class="field1" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
				<span id="valEmail" style="color:Red;visibility:hidden;"></span>
				<br>
				<label class="tag" for="selCountry"><span id="lab_valCountry" class="h331">Country </span></label>
				<select class="input" name="selCountry" id="selCountry" class="list_menu">
					<option value="0" disabled selected> - Seleccionar - </option>
					<option value="1">AFGHANISTAN</option>
					<option value="3">ALBANIA</option>
					<option value="4">ALGERIA</option>
					<option value="5">AMERICAN SAMOA</option>
					<option value="6">ANDORRA</option>
					<option value="7">ANGOLA</option>
					<option value="8">ANGUILLA</option>
					<option value="9">ANTARCTICA</option>
					<option value="10">ANTIGUA AND BARBUDA</option>
					<option value="11">ARGENTINA</option>
					<option value="12">ARMENIA</option>
					<option value="13">ARUBA</option>
					<option value="14">AUSTRALIA</option>
					<option value="15">AUSTRIA</option>
					<option value="16">AZERBAIJAN</option>
					<option value="17">BAHAMAS</option>
					<option value="18">BAHRAIN</option>
					<option value="19">BANGLADESH</option>
					<option value="20">BARBADOS</option>
					<option value="21">BELARUS</option>
					<option value="22">BELGIUM</option>
					<option value="23">BELIZE</option>
					<option value="24">BENIN</option>
					<option value="25">BERMUDA</option>
					<option value="26">BHUTAN</option>
					<option value="27">BOLIVIA</option>
					<option value="28">BOSNIA AND HERZEGOVINA</option>
					<option value="29">BOTSWANA</option>
					<option value="31">BRAZIL</option>
					<option value="33">BRUNEI DARUSSALAM</option>
					<option value="34">BULGARIA</option>
					<option value="35">BURKINA FASO</option>
					<option value="36">BURUNDI</option>
					<option value="37">CAMBODIA</option>
					<option value="38">CAMEROON</option>
					<option value="39">CANADA</option>
					<option value="40">CAPE VERDE</option>
					<option value="41">CAYMAN ISLANDS</option>
					<option value="42">CENTRAL AFRICAN REPUBLIC</option>
					<option value="47">COCOS (KEELING) ISLANDS</option>
					<option selected="selected" value="48">COLOMBIA</option>
					<option value="49">COMOROS</option>
					<option value="50">CONGO</option>
					<option value="51">CONGO, THE DEMOCRATIC REPUBLIC OF THE</option>
					<option value="52">COOK ISLANDS</option>
					<option value="53">COSTA RICA</option>
					<option value="54">CÔTE D´IVOIRE</option>
					<option value="55">CROATIA</option>
					<option value="56">CUBA</option>
					<option value="57">CYPRUS</option>
					<option value="58">CZECH REPUBLIC</option>
					<option value="43">CHAD</option>
					<option value="44">CHILE</option>
					<option value="45">CHINA</option>
					<option value="46">CHRISTMAS ISLAND</option>
					<option value="59">DENMARK</option>
					<option value="60">DJIBOUTI</option>
					<option value="61">DOMINICA</option>
					<option value="62">DOMINICAN REPUBLIC</option>
					<option value="63">ECUADOR</option>
					<option value="64">EGYPT</option>
					<option value="65">EL SALVADOR</option>
					<option value="66">EQUATORIAL GUINEA</option>
					<option value="67">ERITREA</option>
					<option value="206">ESPAÑA</option>
					<option value="68">ESTONIA</option>
					<option value="69">ETHIOPIA</option>
					<option value="70">FALKLAND ISLANDS (MALVINAS)</option>
					<option value="71">FAROE ISLANDS</option>
					<option value="72">FIJI</option>
					<option value="73">FINLAND</option>
					<option value="74">FRANCE</option>
					<option value="75">FRENCH GUIANA</option>
					<option value="76">FRENCH POLYNESIA</option>
					<option value="78">GABON</option>
					<option value="79">GAMBIA</option>
					<option value="80">GEORGIA</option>
					<option value="81">GERMANY</option>
					<option value="82">GHANA</option>
					<option value="83">GIBRALTAR</option>
					<option value="84">GREECE</option>
					<option value="85">GREENLAND</option>
					<option value="86">GRENADA</option>
					<option value="87">GUADELOUPE</option>
					<option value="88">GUAM</option>
					<option value="89">GUATEMALA</option>
					<option value="91">GUINEA</option>
					<option value="92">GUINEA-BISSAU</option>
					<option value="93">GUYANA</option>
					<option value="94">HAITI</option>
					<option value="96">HOLY SEE (VATICAN CITY STATE)</option>
					<option value="97">HONDURAS</option>
					<option value="98">HONG KONG</option>
					<option value="99">HUNGARY</option>
					<option value="100">ICELAND</option>
					<option value="101">INDIA</option>
					<option value="102">INDONESIA</option>
					<option value="103">IRAN, ISLAMIC REPUBLIC OF</option>
					<option value="104">IRAQ</option>
					<option value="105">IRELAND</option>
					<option value="107">ISRAEL</option>
					<option value="108">ITALY</option>
					<option value="109">JAMAICA</option>
					<option value="110">JAPAN</option>
					<option value="112">JORDAN</option>
					<option value="113">KAZAKHSTAN</option>
					<option value="114">KENYA</option>
					<option value="115">KIRIBATI</option>
					<option value="116">KOREA, DEMOCRATIC PEOPLE´S REPUBLIC OF</option>
					<option value="117">KOREA, REPUBLIC OF</option>
					<option value="118">KUWAIT</option>
					<option value="119">KYRGYZSTAN</option>
					<option value="120">LAO PEOPLE´S DEMOCRATIC REPUBLIC</option>
					<option value="121">LATVIA</option>
					<option value="122">LEBANON</option>
					<option value="123">LESOTHO</option>
					<option value="124">LIBERIA</option>
					<option value="125">LIBYAN ARAB JAMAHIRIYA</option>
					<option value="126">LIECHTENSTEIN</option>
					<option value="127">LITHUANIA</option>
					<option value="128">LUXEMBOURG</option>
					<option value="129">MACAO</option>
					<option value="130">MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF</option>
					<option value="131">MADAGASCAR</option>
					<option value="132">MALAWI</option>
					<option value="133">MALAYSIA</option>
					<option value="134">MALDIVES</option>
					<option value="135">MALI</option>
					<option value="136">MALTA</option>
					<option value="137">MARSHALL ISLANDS</option>
					<option value="138">MARTINIQUE</option>
					<option value="139">MAURITANIA</option>
					<option value="140">MAURITIUS</option>
					<option value="141">MAYOTTE</option>
					<option value="142">MEXICO</option>
					<option value="143">MICRONESIA, FEDERATED STATES OF</option>
					<option value="144">MOLDOVA, REPUBLIC OF</option>
					<option value="145">MONACO</option>
					<option value="146">MONGOLIA</option>
					<option value="147">MONTENEGRO</option>
					<option value="148">MONTSERRAT</option>
					<option value="149">MOROCCO</option>
					<option value="150">MOZAMBIQUE</option>
					<option value="151">MYANMAR</option>
					<option value="152">NAMIBIA</option>
					<option value="153">NAURU</option>
					<option value="154">NEPAL</option>
					<option value="155">NETHERLANDS</option>
					<option value="156">NETHERLANDS ANTILLES</option>
					<option value="157">NEW CALEDONIA</option>
					<option value="158">NEW ZEALAND</option>
					<option value="159">NICARAGUA</option>
					<option value="160">NIGER</option>
					<option value="161">NIGERIA</option>
					<option value="162">NIUE</option>
					<option value="163">NORFOLK ISLAND</option>
					<option value="164">NORTHERN MARIANA ISLANDS</option>
					<option value="165">NORWAY</option>
					<option value="166">OMAN</option>
					<option value="167">PAKISTAN</option>
					<option value="168">PALAU</option>
					<option value="169">PALESTINIAN TERRITORY, OCCUPIED</option>
					<option value="170">PANAMA</option>
					<option value="171">PAPUA NEW GUINEA</option>
					<option value="172">PARAGUAY</option>
					<option value="173">PERU</option>
					<option value="174">PHILIPPINES</option>
					<option value="175">PITCAIRN</option>
					<option value="176">POLAND</option>
					<option value="177">PORTUGAL</option>
					<option value="178">PUERTO RICO</option>
					<option value="179">QATAR</option>
					<option value="180">REUNION</option>
					<option value="181">ROMANIA</option>
					<option value="182">RUSSIAN FEDERATION</option>
					<option value="183">RWANDA</option>
					<option value="184">SAINT BARTHÉLEMY</option>
					<option value="185">SAINT HELENA</option>
					<option value="186">SAINT KITTS AND NEVIS</option>
					<option value="187">SAINT LUCIA</option>
					<option value="188">SAINT MARTIN</option>
					<option value="189">SAINT PIERRE AND MIQUELON</option>
					<option value="190">SAINT VINCENT AND THE GRENADINES</option>
					<option value="191">SAMOA</option>
					<option value="192">SAN MARINO</option>
					<option value="193">SAO TOME AND PRINCIPE</option>
					<option value="194">SAUDI ARABIA</option>
					<option value="195">SENEGAL</option>
					<option value="196">SERBIA</option>
					<option value="197">SEYCHELLES</option>
					<option value="198">SIERRA LEONE</option>
					<option value="199">SINGAPORE</option>
					<option value="200">SLOVAKIA</option>
					<option value="201">SLOVENIA</option>
					<option value="202">SOLOMON ISLANDS</option>
					<option value="203">SOMALIA</option>
					<option value="204">SOUTH AFRICA</option>
					<option value="207">SRI LANKA</option>
					<option value="208">SUDAN</option>
					<option value="209">SURINAME</option>
					<option value="211">SWAZILAND</option>
					<option value="212">SWEDEN</option>
					<option value="213">SWITZERLAND</option>
					<option value="214">SYRIAN ARAB REPUBLIC</option>
					<option value="215">TAIWAN, PROVINCE OF CHINA</option>
					<option value="216">TAJIKISTAN</option>
					<option value="217">TANZANIA, UNITED REPUBLIC OF</option>
					<option value="218">THAILAND</option>
					<option value="219">TIMOR-LESTE</option>
					<option value="220">TOGO</option>
					<option value="221">TOKELAU</option>
					<option value="222">TONGA</option>
					<option value="223">TRINIDAD AND TOBAGO</option>
					<option value="224">TUNISIA</option>
					<option value="225">TURKEY</option>
					<option value="226">TURKMENISTAN</option>
					<option value="227">TURKS AND CAICOS ISLANDS</option>
					<option value="228">TUVALU</option>
					<option value="229">UGANDA</option>
					<option value="230">UKRAINE</option>
					<option value="231">UNITED ARAB EMIRATES</option>
					<option value="232">UNITED KINGDOM</option>
					<option value="233">UNITED STATES</option>
					<option value="235">URUGUAY</option>
					<option value="236">UZBEKISTAN</option>
					<option value="237">VANUATU</option>
					<option value="238">VENEZUELA</option>
					<option value="239">VIET NAM</option>
					<option value="240">VIRGIN ISLANDS, BRITISH</option>
					<option value="241">VIRGIN ISLANDS, U.S.</option>
					<option value="242">WALLIS AND FUTUNA</option>
					<option value="244">YEMEN</option>
					<option value="245">ZAMBIA</option>
					<option value="246">ZIMBABWE</option>

				</select>
				<span id="valCountry" style="color:Red;visibility:hidden;"></span>
				<br>
				<label class="tag" for="selPrefix"><span id="lab_valPhone" class="h331">Phone </span></label>
				<select class="input3" name="selPrefix" id="selPrefix" class="list_menu_small">
					<option value=" "> </option>
					<option value="0093">0093</option>
					<option value="00355">00355</option>
					<option value="00213">00213</option>
					<option value="001684">001684</option>
					<option value="00376">00376</option>
					<option value="00244">00244</option>
					<option value="001264">001264</option>
					<option value="00672">00672</option>
					<option value="001268">001268</option>
					<option value="0054">0054</option>
					<option value="00374">00374</option>
					<option value="00297">00297</option>
					<option value="0061">0061</option>
					<option value="0043">0043</option>
					<option value="00994">00994</option>
					<option value="001242">001242</option>
					<option value="00973">00973</option>
					<option value="00880">00880</option>
					<option value="001246">001246</option>
					<option value="00375">00375</option>
					<option value="0032">0032</option>
					<option value="00501">00501</option>
					<option value="00229">00229</option>
					<option value="001441">001441</option>
					<option value="00975">00975</option>
					<option value="00591">00591</option>
					<option value="00387">00387</option>
					<option value="00267">00267</option>
					<option value="0055">0055</option>
					<option value="00673">00673</option>
					<option value="00359">00359</option>
					<option value="00226">00226</option>
					<option value="00257">00257</option>
					<option value="00855">00855</option>
					<option value="00237">00237</option>
					<option value="001">001</option>
					<option value="00238">00238</option>
					<option value="001345">001345</option>
					<option value="00236">00236</option>
					<option value="0061">0061</option>
					<option selected="selected" value="0057">0057</option>
					<option value="00269">00269</option>
					<option value="00243">00243</option>
					<option value="00242">00242</option>
					<option value="00682">00682</option>
					<option value="00506">00506</option>
					<option value="00225">00225</option>
					<option value="00385">00385</option>
					<option value="0053">0053</option>
					<option value="00357">00357</option>
					<option value="00420">00420</option>
					<option value="00235">00235</option>
					<option value="0056">0056</option>
					<option value="0086">0086</option>
					<option value="00618">00618</option>
					<option value="0045">0045</option>
					<option value="00253">00253</option>
					<option value="001767">001767</option>
					<option value="001809">001809</option>
					<option value="00593">00593</option>
					<option value="0020">0020</option>
					<option value="00503">00503</option>
					<option value="00240">00240</option>
					<option value="00291">00291</option>
					<option value="0034">0034</option>
					<option value="00372">00372</option>
					<option value="00251">00251</option>
					<option value="00500">00500</option>
					<option value="00298">00298</option>
					<option value="00679">00679</option>
					<option value="00358">00358</option>
					<option value="0033">0033</option>
					<option value="00594">00594</option>
					<option value="00689">00689</option>
					<option value="00241">00241</option>
					<option value="00220">00220</option>
					<option value="00995">00995</option>
					<option value="0049">0049</option>
					<option value="00233">00233</option>
					<option value="00350">00350</option>
					<option value="0030">0030</option>
					<option value="00299">00299</option>
					<option value="001473">001473</option>
					<option value="00590">00590</option>
					<option value="001671">001671</option>
					<option value="00502">00502</option>
					<option value="00224">00224</option>
					<option value="00245">00245</option>
					<option value="00592">00592</option>
					<option value="00509">00509</option>
					<option value="0039">0039</option>
					<option value="00504">00504</option>
					<option value="00852">00852</option>
					<option value="0036">0036</option>
					<option value="00354">00354</option>
					<option value="0091">0091</option>
					<option value="0062">0062</option>
					<option value="0098">0098</option>
					<option value="00964">00964</option>
					<option value="00353">00353</option>
					<option value="00972">00972</option>
					<option value="0039">0039</option>
					<option value="001876">001876</option>
					<option value="0081">0081</option>
					<option value="00962">00962</option>
					<option value="007">007</option>
					<option value="00254">00254</option>
					<option value="00686">00686</option>
					<option value="00850">00850</option>
					<option value="0082">0082</option>
					<option value="00965">00965</option>
					<option value="00996">00996</option>
					<option value="00856">00856</option>
					<option value="00371">00371</option>
					<option value="00961">00961</option>
					<option value="00266">00266</option>
					<option value="00231">00231</option>
					<option value="00218">00218</option>
					<option value="00423">00423</option>
					<option value="00370">00370</option>
					<option value="00352">00352</option>
					<option value="00853">00853</option>
					<option value="00389">00389</option>
					<option value="00261">00261</option>
					<option value="00265">00265</option>
					<option value="0060">0060</option>
					<option value="00960">00960</option>
					<option value="00223">00223</option>
					<option value="00356">00356</option>
					<option value="00692">00692</option>
					<option value="00596">00596</option>
					<option value="00222">00222</option>
					<option value="00230">00230</option>
					<option value="00269">00269</option>
					<option value="0052">0052</option>
					<option value="00691">00691</option>
					<option value="00373">00373</option>
					<option value="00377">00377</option>
					<option value="00976">00976</option>
					<option value="00382">00382</option>
					<option value="001664">001664</option>
					<option value="00212">00212</option>
					<option value="00258">00258</option>
					<option value="0095">0095</option>
					<option value="00264">00264</option>
					<option value="00674">00674</option>
					<option value="00977">00977</option>
					<option value="0031">0031</option>
					<option value="00599">00599</option>
					<option value="00687">00687</option>
					<option value="0064">0064</option>
					<option value="00505">00505</option>
					<option value="00227">00227</option>
					<option value="00234">00234</option>
					<option value="00683">00683</option>
					<option value="00672">00672</option>
					<option value="001670">001670</option>
					<option value="0047">0047</option>
					<option value="00968">00968</option>
					<option value="0092">0092</option>
					<option value="00680">00680</option>
					<option value="00970">00970</option>
					<option value="00507">00507</option>
					<option value="00675">00675</option>
					<option value="00595">00595</option>
					<option value="0051">0051</option>
					<option value="0063">0063</option>
					<option value="0064">0064</option>
					<option value="0048">0048</option>
					<option value="00351">00351</option>
					<option value="001787">001787</option>
					<option value="00974">00974</option>
					<option value="00262">00262</option>
					<option value="0040">0040</option>
					<option value="007">007</option>
					<option value="00250">00250</option>
					<option value="00590">00590</option>
					<option value="00290">00290</option>
					<option value="001869">001869</option>
					<option value="001758">001758</option>
					<option value="00590">00590</option>
					<option value="00508">00508</option>
					<option value="001784">001784</option>
					<option value="00685">00685</option>
					<option value="00378">00378</option>
					<option value="00239">00239</option>
					<option value="00966">00966</option>
					<option value="00221">00221</option>
					<option value="00381">00381</option>
					<option value="00248">00248</option>
					<option value="00232">00232</option>
					<option value="0065">0065</option>
					<option value="00421">00421</option>
					<option value="00386">00386</option>
					<option value="00677">00677</option>
					<option value="00252">00252</option>
					<option value="0027">0027</option>
					<option value="0094">0094</option>
					<option value="00249">00249</option>
					<option value="00597">00597</option>
					<option value="00268">00268</option>
					<option value="0046">0046</option>
					<option value="0041">0041</option>
					<option value="00963">00963</option>
					<option value="00886">00886</option>
					<option value="00992">00992</option>
					<option value="00255">00255</option>
					<option value="0066">0066</option>
					<option value="00670">00670</option>
					<option value="00228">00228</option>
					<option value="00690">00690</option>
					<option value="00676">00676</option>
					<option value="001868">001868</option>
					<option value="00216">00216</option>
					<option value="0090">0090</option>
					<option value="00993">00993</option>
					<option value="001649">001649</option>
					<option value="00688">00688</option>
					<option value="00256">00256</option>
					<option value="00380">00380</option>
					<option value="00971">00971</option>
					<option value="0044">0044</option>
					<option value="001">001</option>
					<option value="00598">00598</option>
					<option value="00998">00998</option>
					<option value="00678">00678</option>
					<option value="0058">0058</option>
					<option value="0084">0084</option>
					<option value="001284">001284</option>
					<option value="001340">001340</option>
					<option value="00681">00681</option>
					<option value="00967">00967</option>
					<option value="00260">00260</option>
					<option value="00263">00263</option>

				</select>
				<input class="input2" name="txtPhone" type="text" maxlength="15" id="txtPhone" class="field2">
				<span id="valPhone" style="color:Red;visibility:hidden;"></span>
				<div id="divPhoneData" style="display:none;">
					<label class="tag_msg" id="lblPhoneData">&nbsp;</label>
				</div>
				<br>
				<label class="tag" for="selReference"><span class="h331">How did you know us?</span></label>
				<select class="input" name="selReference" id="selReference" class="list_menu">
					<option value="0"> - Select - </option>							
					<option value="2">Blog o Foro</option>
					<option value="3">Mail</option>
					<option value="4">Reference:Colleague</option>
					<option value="5">Referencia:Friend</option>
					<option value="6">Google</option>
					<option value="7">Facebook</option>
					<option value="8">LinkedIn</option>
					<option value="9">Twitter</option>
				</select><br>			
				<button type="submit" onclick="pregunta()" class="boton-verde">Send Information</button><br>
			</form>				
		</div>
	</div>
	<script language="JavaScript"> 
		function pregunta(){ 
			if (confirm('I affirm that the information entered is true')){ 
				
			} 
		} 
	</script> 
	<div id="panelDer"  class="animated zoomIn">
		<div class="wrapper">			
			<section class="billboard">	
				<script src="http://maps.googleapis.com/maps/api/js"></script>
				<script>
					function initialize()
					{
					  var mapProp = {
					    center: new google.maps.LatLng(4.651876, -74.062751),
					    zoom:17,
					    mapTypeId: google.maps.MapTypeId.ROADMAP
					  };
					  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
					  var marcador = new google.maps.Marker({
/*Creamos un marcador*/
                position: new google.maps.LatLng(4.651876, -74.062751), /*Lo situamos en nuestro punto */
                map: map, /* Lo vinculamos a nuestro mapa */
                title: "We Are Here" 
            })
					  
					}

					function loadScript()
					{
					  var script = document.createElement("script");
					  script.type = "text/javascript";
					  script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
					  document.body.appendChild(script);
					}

					window.onload = loadScript;
					</script>
				<div id="googleMap"></div>
			</section>
		</div>
	</div>
	<footer class="footer-distributed">
		<div class="footer-left">
			<span><img src="img/logoEscala.png" width="210" height="120"></span>
			<p class="footer-links">
				 <a href="indexEnglish.php">Home</a>
	            ·
	            <a href="ourClients.html">Customers</a>
	            ·
	            <a href="indexEnglish.php">¿Who Are We?</a>					
	            ·
	            <a href="contactUs">Contact</a>
			</p>
			<p class="footer-company-name">Productivity Manager &copy; 2015</p>
		</div>
		<div class="footer-center">
			<div>
				<i class="fa fa-map-marker"></i>
				<p><span>Street 65 Number 13 - 21</span> Bogotá, Colombia</p>
			</div>
			<div>
				<i class="fa fa-phone"></i>
				<p>+57 301 5782659</p>
			</div>
			<div>
				<i class="fa fa-envelope"></i>
				<p><a href="mailto:productivitymanagersoftware@gmail.com">productivitymanagersoftware@gmail.com</a></p>
			</div>
		</div>
		<div class="footer-right">
			<p class="footer-company-about">
				<span>Productivity Manager</span>
				To increase productivity is absolutely necessary to incorporate the best workers
			</p>
			<div class="footer-icons">
				<a href="https://www.facebook.com/productivitymanager"><img src="img/facebookFoot.png"></a>
				<a href="https://twitter.com/Productivity_Mg"><img src="img/twitterFoot.png"></a>					
				<a href="mailto:productivitymanagersoftware@gmail.com"></i><img src="img/gmailFoot.png"></a>
			</div>
		</div>
	</footer>	
</body>
  <script>
        $(document).ready(function(){
        //eliminamos el scroll de la pagina
        $("body").css({"overflow-y":"hidden"});
        //guardamos en una variable el alto del que tiene tu browser que no es lo mismo que del DOM
        var alto=$(window).height();
        //agregamos en el body un div que sera que ocupe toda la pantalla y se muestra encima de todo
        $("body").append('<div id="pre-load-web"><div id="imagen-load"><img src="img/loader.gif" alt=""></div></div>'); 
        //le damos el alto 
       $("#pre-load-web").css({height:alto+"px"}); 
       //esta sera la capa que esta dento de la capa que muestra un gif 
       $("#imagen-load").css({"margin-top":(alto/2)-30+"px"}); 
        })     
        $(window).load(function(){ 
        $("#pre-load-web").fadeOut(1000,function() { //eliminamos la capa de precarga $(this).remove();
        //permitimos scroll 
        $("body").css({"overflow-y":"auto"}); }); 
         
        })
    </script>
    <style>
    #pre-load-web {width:100%;position:absolute;background:#fff;left:0px;top:0px;z-index:100000}
    /*aqui centramos la imagen si coloco margin left -30 es por que la imagen mide 60 */
    #pre-load-web #imagen-load{left:48%;margin-left:-30px;position:absolute}
    </style>
</html>