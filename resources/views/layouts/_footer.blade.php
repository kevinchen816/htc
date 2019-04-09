    <footer id="footer" class="container-fluid">
        <section id="top-footer" class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 footer-list">
                <div class="row">
                    <!--<div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <p><strong>Australia</strong></p>
                            <p>xxxx</p>
                            <p>xxxx</p>
                        </div>
                    </div>-->

@if (env('APP_REGION') == 'eu')
<!--                     <div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <p><strong>Vigilmax GmbH</strong></p>
                            <p>Koelner Str. 58a</p>
                            <p>51645 Gummersbach</p>
                            <p>GERMANY</p>
                            <p></p>
                            <p></p>
                            <a></a>
                        </div>
                    </div> -->
@elseif (env('APP_REGION') == 'au')
                    <div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <p><strong>Australia</strong></p>
                            <p>Unit 11, 189 Anzac Avenue</p>
                            <p>Toowoomba, Queensland 4350</p>
                            <p>Tel: 1300 544 249</p>
                            <p>info@outdoorcameras.com.au</p>
                            <p></p>
                            <a>https://outdoorcameras.com.au/</a>
                        </div>
                    </div>
@elseif (env('APP_REGION') == 'tw')
                    <div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <p><strong>台灣</strong></p>
                            <p>聯絡電話：+886-7-722-4900</p>
                            <p>聯絡手機：0921256705</p>
                            <p>傳真電話：+886-7-722-4747</p>
                            <p>聯絡地址：802 高雄市苓雅區武昌路200號2樓</p>
                            <p>聯絡信箱：sales@longintech.com</p>
                            <!-- <a>http://www.longintech.com/</a> -->
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <p><strong>Taiwan</strong></p>
                            <p>Phone：+886-7-722-4900</p>
                            <p>Mobile：0921256705</p>
                            <p>Fax：+886-7-722-4747</p>
                            <p>Address：80275 2F,No.200,Wuchang Rd., Lingya District, Kaohsiung city 80275, Taiwan, R.O.C.</p>
                            <p>E-mail：sales@longintech.com</p>
                            <!-- <a>http://www.longintech.com/</a> -->
                        </div>
                    </div>
@elseif (env('APP_REGION') == 'cn')

@else

@endif

@if (0)
                    <div class="col-md-4 col-sm-4 footer-list-item">
                        <div class="address alert" style="background-color:#444; height: 200px;">
                            <!--<p><strong>Contact</strong></p>-->
                            <p>Technical Support</p>
                            <!--<p><a href="tel:x-xxx-xxx-xxx">x-xxx-xxx-xxx</a></p>-->
                            <p><a href="mailto:xxx@xxx.com">{{ env('APP_SUPPORT') }}</a></p>
                        </div>
                    </div>
@endif
                </div>
            </div>
        </section>
        <section class="row" id="footer-bottom">
            <div class="col-sm-12 text-center">
                <p class="copyright">&copy;2018 {{ env('APP_NAME') }} All rights reserved.</p>
            </div>
        </section>

    </footer>