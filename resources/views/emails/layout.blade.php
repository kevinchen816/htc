<html>
    <style type="text/css"  rel="stylesheet"  media="all"></style>

    <table width="100%"  cellpadding="0"  cellspacing="0">
        <tr>
            <td style="width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;"  align="center">
                <table width="100%"  cellpadding="0"  cellspacing="0">

                    <tr>
                        <td style="padding: 25px 0; text-align: center;">
                            <a style=""  href="{{ route('home') }}"  target="_blank">
                                {{ config('app.name') }}
                            </a>
                        </td>
                    </tr>


                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;"  width="100%">
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;"  align="center"  width="570"  cellpadding="0"  cellspacing="0">
                                <tr>
                                    <td style="">

                                            @yield('content')

<!--                                             <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                                Click this link to stop the site from sending any emails to your address:<br/>
                                                <a href="http://www.ridgetec.us/email/optout">
                                                    Change Email Preference and Opt Out
                                                </a>
                                            </p> -->
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;"  align="center"  width="570"  cellpadding="0"  cellspacing="0">
                                <tr>
                                    <td style="">
                                        <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                            &copy; 2019
                                            <a style="color: #3869D4;"  href="{{ route('home') }}"  target="_blank">{{ config('app.name') }}</a>.
                                            All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</html>