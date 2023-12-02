@extends('emails.layouts.app')
@section('content')

<div class="content">

    <td align="left">

        <table border="0" width="80%" align="center" cellpadding="0" cellspacing="0" class="container590">

            <tr>

                <td align="left" style="color: #888888; width:20px; font-size: 16px; line-height: 24px;">

                    <!-- section text ======-->
                     <p style="line-height: 24px; margin-bottom:15px;">

                        Hello! {{$user['name']}},

                    </p>

                    <p style="line-height: 24px; margin-bottom:20px;">

                        Thanks for contact us.We will contact you soon!!

                    </p>
                    <p style="line-height: 24px; margin-bottom:20px;">

                       For regarding,<br> {{$user['message']}}

                    </p>


                    <p style="line-height: 24px">

                        Regards,</br>

                        @yield('title', app_name())

                    </p>

 <br/>

 @include('emails.layouts.footer')

                </td>

            </tr>

        </table>

    </td>

</div>

@endsection

                        