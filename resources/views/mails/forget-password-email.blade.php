@include('mails.header')
<!-- Email Body -->
<table>
    <tr>
        <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                Hi : {{ $name }}</p>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                    Email : {{ $email }}</p>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                If you've forgotten your password, don't worry! Click the link below to reset your password and regain
                access to your Julia-real-state account.</p>
            </p>
            <a href="{{ $url }}">Click here to reset password</a>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                If you didn't request this change, please contact our support team immediately.<br>

            <h5>Thanks & Regards</h5>
            <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
                Date: {{ date('d-m-Y') }}</p>

        </td>
    </tr>
</table>

<!-- Email Body  end-->

@include('mails.footer')
