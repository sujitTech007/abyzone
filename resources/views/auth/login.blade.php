@include('include.header')

<style>
    .frm_grp.select_country .dropdown.bootstrap-select {
        width: max-content !important;
    }

    .frm_grp.select_country button.btn.dropdown-toggle.btn-light {
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        color: var(--bs-body-color);
        height: 45px;
        padding: 10px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        width: max-content;
        min-width: 100px;
    }

    .frm_grp.select_country .bs-searchbox input.form-control {
        padding: 0;
        line-height: 35px;
        height: auto;
    }

    .frm_grp.select_country ul.dropdown-menu.inner.show li a {
        font-size: 15px;
        padding: 5px 10px;
    }

    .sec-signup .form-label {
        margin-bottom: 4px;
    }
</style>

<section class="sec-signup py-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 login-box">


                <div class="logo d-flex justify-content-center">
                    <img class="img-fluid" src="assets/images/images/qby-logo.png" alt="ABYzone Logo" height="50"
                        width="132">
                </div>

                <h2 class="text-center mt-2"><u>Login</u></h2>

                <form method="POST" action="{{ route('auth.login.post') }}">

                    @csrf



                    <!--<div class="mb-3">-->

                    <!--    <label for="phone" class="form-label fw-semibold">Phone</label>-->
                    <!--    <fieldset>-->
                    <!--        <div class="frm_grp select_country d-flex align-items-center gap-2">-->
                    <!--            <select id="login_country_code" name="country_code" data-live-search="true" class="selectpicker">-->
                    <!--                 <option data-content='<img src="https://flagcdn.com/16x12/dz.png" class="me-1">Algeria +213' value="+213">Algeria +213</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/us.png" class="me-1">United States +1' value="+1">United States +1</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ad.png" class="me-1">Andorra +376' value="+376">Andorra +376</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ao.png" class="me-1">Angola +244' value="+244">Angola +244</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ag.png" class="me-1">Antigua +1-268' value="+1-268">Antigua +1-268</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ar.png" class="me-1">Argentina +54' value="+54">Argentina +54</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/am.png" class="me-1">Armenia +374' value="+374">Armenia +374</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/aw.png" class="me-1">Aruba +297' value="+297">Aruba +297</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/au.png" class="me-1">Australia +61' value="+61">Australia +61</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/at.png" class="me-1">Austria +43' value="+43">Austria +43</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/az.png" class="me-1">Azerbaijan +994' value="+994">Azerbaijan +994</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bh.png" class="me-1">Bahrain +973' value="+973">Bahrain +973</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bd.png" class="me-1">Bangladesh +880' value="+880">Bangladesh +880</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bb.png" class="me-1">Barbados +1-246' value="+1-246">Barbados +1-246</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/by.png" class="me-1">Belarus +375' value="+375">Belarus +375</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/be.png" class="me-1">Belgium +32' value="+32">Belgium +32</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bz.png" class="me-1">Belize +501' value="+501">Belize +501</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bj.png" class="me-1">Benin +229' value="+229">Benin +229</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bt.png" class="me-1">Bhutan +975' value="+975">Bhutan +975</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bo.png" class="me-1">Bolivia +591' value="+591">Bolivia +591</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ba.png" class="me-1">Bosnia +387' value="+387">Bosnia +387</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bw.png" class="me-1">Botswana +267' value="+267">Botswana +267</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/br.png" class="me-1">Brazil +55' value="+55">Brazil +55</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/io.png" class="me-1">British Indian Ocean +246' value="+246">British Indian Ocean +246</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bn.png" class="me-1">Brunei +673' value="+673">Brunei +673</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bg.png" class="me-1">Bulgaria +359' value="+359">Bulgaria +359</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bf.png" class="me-1">Burkina Faso +226' value="+226">Burkina Faso +226</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bi.png" class="me-1">Burundi +257' value="+257">Burundi +257</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kh.png" class="me-1">Cambodia +855' value="+855">Cambodia +855</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cm.png" class="me-1">Cameroon +237' value="+237">Cameroon +237</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ca.png" class="me-1">Canada +1' value="+1" selected>Canada +1</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cv.png" class="me-1">Cape Verde +238' value="+238">Cape Verde +238</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cf.png" class="me-1">Central Africa +236' value="+236">Central Africa +236</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/td.png" class="me-1">Chad +235' value="+235">Chad +235</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cl.png" class="me-1">Chile +56' value="+56">Chile +56</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cn.png" class="me-1">China +86' value="+86">China +86</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/co.png" class="me-1">Colombia +57' value="+57">Colombia +57</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/km.png" class="me-1">Comoros +269' value="+269">Comoros +269</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cg.png" class="me-1">Congo +242' value="+242">Congo +242</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cd.png" class="me-1">Democratic Congo +243' value="+243">Democratic Congo +243</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ck.png" class="me-1">Cook Islands +682' value="+682">Cook Islands +682</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cr.png" class="me-1">Costa Rica +506' value="+506">Costa Rica +506</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/hr.png" class="me-1">Croatia +385' value="+385">Croatia +385</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cu.png" class="me-1">Cuba +53' value="+53">Cuba +53</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cy.png" class="me-1">Cyprus +357' value="+357">Cyprus +357</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/cz.png" class="me-1">Czech Republic +420' value="+420">Czech Republic +420</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/dk.png" class="me-1">Denmark +45' value="+45">Denmark +45</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/dj.png" class="me-1">Djibouti +253' value="+253">Djibouti +253</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/dm.png" class="me-1">Dominica +1-767' value="+1-767">Dominica +1-767</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/do.png" class="me-1">Dominican Republic +1-809' value="+1-809">Dominican Republic +1-809</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ec.png" class="me-1">Ecuador +593' value="+593">Ecuador +593</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/eg.png" class="me-1">Egypt +20' value="+20">Egypt +20</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sv.png" class="me-1">El Salvador +503' value="+503">El Salvador +503</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gq.png" class="me-1">Equatorial Guinea +240' value="+240">Equatorial Guinea +240</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/er.png" class="me-1">Eritrea +291' value="+291">Eritrea +291</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ee.png" class="me-1">Estonia +372' value="+372">Estonia +372</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/et.png" class="me-1">Ethiopia +251' value="+251">Ethiopia +251</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/fj.png" class="me-1">Fiji +679' value="+679">Fiji +679</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/fi.png" class="me-1">Finland +358' value="+358">Finland +358</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/fr.png" class="me-1">France +33' value="+33">France +33</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gf.png" class="me-1">French Guiana +594' value="+594">French Guiana +594</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pf.png" class="me-1">French Polynesia +689' value="+689">French Polynesia +689</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ga.png" class="me-1">Gabon +241' value="+241">Gabon +241</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gm.png" class="me-1">Gambia +220' value="+220">Gambia +220</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ge.png" class="me-1">Georgia +995' value="+995">Georgia +995</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/de.png" class="me-1">Germany +49' value="+49">Germany +49</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gh.png" class="me-1">Ghana +233' value="+233">Ghana +233</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gi.png" class="me-1">Gibraltar +350' value="+350">Gibraltar +350</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gr.png" class="me-1">Greece +30' value="+30">Greece +30</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gl.png" class="me-1">Greenland +299' value="+299">Greenland +299</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gd.png" class="me-1">Grenada +1-473' value="+1-473">Grenada +1-473</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gp.png" class="me-1">Guadeloupe +590' value="+590">Guadeloupe +590</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gu.png" class="me-1">Guam +1-671' value="+1-671">Guam +1-671</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gt.png" class="me-1">Guatemala +502' value="+502">Guatemala +502</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gn.png" class="me-1">Guinea +224' value="+224">Guinea +224</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gw.png" class="me-1">Guinea-Bissau +245' value="+245">Guinea-Bissau +245</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gy.png" class="me-1">Guyana +592' value="+592">Guyana +592</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ht.png" class="me-1">Haiti +509' value="+509">Haiti +509</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/hn.png" class="me-1">Honduras +504' value="+504">Honduras +504</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/hk.png" class="me-1">Hong Kong +852' value="+852">Hong Kong +852</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/hu.png" class="me-1">Hungary +36' value="+36">Hungary +36</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/is.png" class="me-1">Iceland +354' value="+354">Iceland +354</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/in.png" class="me-1">India +91' value="+91">India +91</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/id.png" class="me-1">Indonesia +62' value="+62">Indonesia +62</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ir.png" class="me-1">Iran +98' value="+98">Iran +98</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/iq.png" class="me-1">Iraq +964' value="+964">Iraq +964</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ie.png" class="me-1">Ireland +353' value="+353">Ireland +353</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/il.png" class="me-1">Israel +972' value="+972">Israel +972</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/it.png" class="me-1">Italy +39' value="+39">Italy +39</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/jm.png" class="me-1">Jamaica +1-876' value="+1-876">Jamaica +1-876</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/jp.png" class="me-1">Japan +81' value="+81">Japan +81</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/jo.png" class="me-1">Jordan +962' value="+962">Jordan +962</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kz.png" class="me-1">Kazakhstan +7' value="+7">Kazakhstan +7</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ke.png" class="me-1">Kenya +254' value="+254">Kenya +254</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ki.png" class="me-1">Kiribati +686' value="+686">Kiribati +686</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kw.png" class="me-1">Kuwait +965' value="+965">Kuwait +965</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kg.png" class="me-1">Kyrgyzstan +996' value="+996">Kyrgyzstan +996</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/la.png" class="me-1">Laos +856' value="+856">Laos +856</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lv.png" class="me-1">Latvia +371' value="+371">Latvia +371</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lb.png" class="me-1">Lebanon +961' value="+961">Lebanon +961</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ls.png" class="me-1">Lesotho +266' value="+266">Lesotho +266</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lr.png" class="me-1">Liberia +231' value="+231">Liberia +231</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ly.png" class="me-1">Libya +218' value="+218">Libya +218</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/li.png" class="me-1">Liechtenstein +423' value="+423">Liechtenstein +423</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lt.png" class="me-1">Lithuania +370' value="+370">Lithuania +370</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lu.png" class="me-1">Luxembourg +352' value="+352">Luxembourg +352</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mo.png" class="me-1">Macau +853' value="+853">Macau +853</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mk.png" class="me-1">Macedonia +389' value="+389">Macedonia +389</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mg.png" class="me-1">Madagascar +261' value="+261">Madagascar +261</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mw.png" class="me-1">Malawi +265' value="+265">Malawi +265</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/my.png" class="me-1">Malaysia +60' value="+60">Malaysia +60</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mv.png" class="me-1">Maldives +960' value="+960">Maldives +960</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ml.png" class="me-1">Mali +223' value="+223">Mali +223</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mt.png" class="me-1">Malta +356' value="+356">Malta +356</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mh.png" class="me-1">Marshall Islands +692' value="+692">Marshall Islands +692</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mq.png" class="me-1">Martinique +596' value="+596">Martinique +596</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mr.png" class="me-1">Mauritania +222' value="+222">Mauritania +222</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mu.png" class="me-1">Mauritius +230' value="+230">Mauritius +230</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/yt.png" class="me-1">Mayotte +262' value="+262">Mayotte +262</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mx.png" class="me-1">Mexico +52' value="+52">Mexico +52</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/fm.png" class="me-1">Micronesia +691' value="+691">Micronesia +691</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/md.png" class="me-1">Moldova +373' value="+373">Moldova +373</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mc.png" class="me-1">Monaco +377' value="+377">Monaco +377</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mn.png" class="me-1">Mongolia +976' value="+976">Mongolia +976</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/me.png" class="me-1">Montenegro +382' value="+382">Montenegro +382</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ms.png" class="me-1">Montserrat +1-664' value="+1-664">Montserrat +1-664</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ma.png" class="me-1">Morocco +212' value="+212">Morocco +212</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mz.png" class="me-1">Mozambique +258' value="+258">Mozambique +258</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mm.png" class="me-1">Myanmar +95' value="+95">Myanmar +95</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/na.png" class="me-1">Namibia +264' value="+264">Namibia +264</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/nr.png" class="me-1">Nauru +674' value="+674">Nauru +674</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/np.png" class="me-1">Nepal +977' value="+977">Nepal +977</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/nl.png" class="me-1">Netherlands +31' value="+31">Netherlands +31</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/nc.png" class="me-1">New Caledonia +687' value="+687">New Caledonia +687</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/nz.png" class="me-1">New Zealand +64' value="+64">New Zealand +64</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ni.png" class="me-1">Nicaragua +505' value="+505">Nicaragua +505</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ne.png" class="me-1">Niger +227' value="+227">Niger +227</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ng.png" class="me-1">Nigeria +234' value="+234">Nigeria +234</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12.nu.png" class="me-1">Niue +683' value="+683">Niue +683</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/nf.png" class="me-1">Norfolk Island +672' value="+672">Norfolk Island +672</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kp.png" class="me-1">North Korea +850' value="+850">North Korea +850</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mp.png" class="me-1">Northern Mariana +1-670' value="+1-670">Northern Mariana +1-670</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/no.png" class="me-1">Norway +47' value="+47">Norway +47</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/om.png" class="me-1">Oman +968' value="+968">Oman +968</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pk.png" class="me-1">Pakistan +92' value="+92">Pakistan +92</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pw.png" class="me-1">Palau +680' value="+680">Palau +680</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ps.png" class="me-1">Palestine +970' value="+970">Palestine +970</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pa.png" class="me-1">Panama +507' value="+507">Panama +507</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pg.png" class="me-1">Papua New Guinea +675' value="+675">Papua New Guinea +675</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/py.png" class="me-1">Paraguay +595' value="+595">Paraguay +595</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pe.png" class="me-1">Peru +51' value="+51">Peru +51</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ph.png" class="me-1">Philippines +63' value="+63">Philippines +63</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pl.png" class="me-1">Poland +48' value="+48">Poland +48</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pt.png" class="me-1">Portugal +351' value="+351">Portugal +351</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pr.png" class="me-1">Puerto Rico +1-787' value="+1-787">Puerto Rico +1-787</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/qa.png" class="me-1">Qatar +974' value="+974">Qatar +974</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ro.png" class="me-1">Romania +40' value="+40">Romania +40</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ru.png" class="me-1">Russia +7' value="+7">Russia +7</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/rw.png" class="me-1">Rwanda +250' value="+250">Rwanda +250</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/bl.png" class="me-1">Saint Barthelemy +590' value="+590">Saint Barthelemy +590</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sh.png" class="me-1">Saint Helena +290' value="+290">Saint Helena +290</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kn.png" class="me-1">Saint Kitts +1-869' value="+1-869">Saint Kitts +1-869</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lc.png" class="me-1">Saint Lucia +1-758' value="+1-758">Saint Lucia +1-758</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/mf.png" class="me-1">Saint Martin +590' value="+590">Saint Martin +590</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/pn.png" class="me-1">Saint Pierre +508' value="+508">Saint Pierre +508</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/vc.png" class="me-1">Saint Vincent +1-784' value="+1-784">Saint Vincent +1-784</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ws.png" class="me-1">Samoa +685' value="+685">Samoa +685</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sm.png" class="me-1">San Marino +378' value="+378">San Marino +378</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/st.png" class="me-1">Sao Tome +239' value="+239">Sao Tome +239</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sa.png" class="me-1">Saudi Arabia +966' value="+966">Saudi Arabia +966</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sn.png" class="me-1">Senegal +221' value="+221">Senegal +221</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/rs.png" class="me-1">Serbia +381' value="+381">Serbia +381</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sc.png" class="me-1">Seychelles +248' value="+248">Seychelles +248</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sl.png" class="me-1">Sierra Leone +232' value="+232">Sierra Leone +232</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sg.png" class="me-1">Singapore +65' value="+65">Singapore +65</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sk.png" class="me-1">Slovakia +421' value="+421">Slovakia +421</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/si.png" class="me-1">Slovenia +386' value="+386">Slovenia +386</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sb.png" class="me-1">Solomon Islands +677' value="+677">Solomon Islands +677</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/so.png" class="me-1">Somalia +252' value="+252">Somalia +252</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/za.png" class="me-1">South Africa +27' value="+27">South Africa +27</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/kr.png" class="me-1">South Korea +82' value="+82">South Korea +82</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ss.png" class="me-1">South Sudan +211' value="+211">South Sudan +211</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/es.png" class="me-1">Spain +34' value="+34">Spain +34</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/lk.png" class="me-1">Sri Lanka +94' value="+94">Sri Lanka +94</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sd.png" class="me-1">Sudan +249' value="+249">Sudan +249</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sr.png" class="me-1">Suriname +597' value="+597">Suriname +597</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sj.png" class="me-1">Svalbard +47' value="+47">Svalbard +47</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sz.png" class="me-1">Eswatini +268' value="+268">Eswatini +268</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/se.png" class="me-1">Sweden +46' value="+46">Sweden +46</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ch.png" class="me-1">Switzerland +41' value="+41">Switzerland +41</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/sy.png" class="me-1">Syria +963' value="+963">Syria +963</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tw.png" class="me-1">Taiwan +886' value="+886">Taiwan +886</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tj.png" class="me-1">Tajikistan +992' value="+992">Tajikistan +992</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tz.png" class="me-1">Tanzania +255' value="+255">Tanzania +255</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/th.png" class="me-1">Thailand +66' value="+66">Thailand +66</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tg.png" class="me-1">Togo +228' value="+228">Togo +228</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tk.png" class="me-1">Tokelau +690' value="+690">Tokelau +690</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/to.png" class="me-1">Tonga +676' value="+676">Tonga +676</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tt.png" class="me-1">Trinidad & Tobago +1-868' value="+1-868">Trinidad & Tobago +1-868</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tn.png" class="me-1">Tunisia +216' value="+216">Tunisia +216</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tr.png" class="me-1">Turkey +90' value="+90">Turkey +90</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tm.png" class="me-1">Turkmenistan +993' value="+993">Turkmenistan +993</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tc.png" class="me-1">Turks & Caicos +1-649' value="+1-649">Turks & Caicos +1-649</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/tv.png" class="me-1">Tuvalu +688' value="+688">Tuvalu +688</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ug.png" class="me-1">Uganda +256' value="+256">Uganda +256</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ua.png" class="me-1">Ukraine +380' value="+380">Ukraine +380</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ae.png" class="me-1">United Arab Emirates +971' value="+971">United Arab Emirates +971</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/gb.png" class="me-1">United Kingdom +44' value="+44">United Kingdom +44</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/uy.png" class="me-1">Uruguay +598' value="+598">Uruguay +598</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/uz.png" class="me-1">Uzbekistan +998' value="+998">Uzbekistan +998</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/vu.png" class="me-1">Vanuatu +678' value="+678">Vanuatu +678</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ve.png" class="me-1">Venezuela +58' value="+58">Venezuela +58</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/vn.png" class="me-1">Vietnam +84' value="+84">Vietnam +84</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/vg.png" class="me-1">British Virgin Islands +1-284' value="+1-284">British Virgin Islands +1-284</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/vi.png" class="me-1">US Virgin Islands +1-340' value="+1-340">US Virgin Islands +1-340</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/wf.png" class="me-1">Wallis & Futuna +681' value="+681">Wallis & Futuna +681</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/eh.png" class="me-1">Western Sahara +212' value="+212">Western Sahara +212</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/ye.png" class="me-1">Yemen +967' value="+967">Yemen +967</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/zm.png" class="me-1">Zambia +260' value="+260">Zambia +260</option>-->
                    <!--        <option data-content='<img src="https://flagcdn.com/16x12/zw.png" class="me-1">Zimbabwe +263' value="+263">Zimbabwe +263</option>-->
                    <!--            </select>-->
                    <!--            <input class="form-control" name="phone" type="tel" placeholder="e.g. +1 234 567 8900" value="{{ old('phone') }}" required>-->
                    <!--        </div>-->
                    <!--    </fieldset>-->
                    <!--    @error('phone')<div class="text-danger">{{ $message }}</div>@enderror-->
                    <!--</div>-->



                    <div class="mb-3">

                        <label for="email" class="form-label fw-semibold">Email</label>

                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"
                            required>

                        @error('email')
                        <div class="text-danger">{{ $message }}</div>@enderror

                    </div>
                    <div class="mb-3">

                        <label for="password" class="form-label fw-semibold">Password</label>

                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter Password" required>

                        @error('password')
                        <div class="text-danger">{{ $message }}</div>@enderror

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <p class="mb-0">

                            Don't have an account?

                            <a href="{{ route('auth.register') }}">Sign up</a>

                        </p>

                        <p class="mb-0">

                            <a href="{{ route('auth.forgot') }}">Forgot password?</a>

                        </p>

                    </div>



                    <div class="text-center">

                        <button type="submit" class="btn btn-primary">Login</button>

                    </div>

                </form>

                {{-- <div class="text-center mt-4" style="

    border: 1px solid #1c1a42;

    border-radius: 5px;

    padding: 5px;

">


                    <a href="{{ route('google.login') }}" class="google-btn">

                        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                            style="width:25px; height:25px; margin-right: 10px;">

                        <span>Login with Google</span>

                    </a>

                </div>
                --}}





            </div>

            {{-- right column --}}
            <div class="col-lg-6 empty-div"></div>


        </div>

    </div>

</section>

@include('include.footer')




<script>
    $(document).ready(function () {
        $('.selectpicker').selectpicker();
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

<!-- Bootstrap JS & jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>


<script>
    AOS.init({
        duration: 1200,
    });
</script>