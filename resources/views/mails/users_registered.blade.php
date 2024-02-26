@include('mails.header')
<!-- Email Body -->
<tr>
    <td class="content-cell" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;">
        <h1>Welcome {{ $email }},</h1>

    <p>Beste {{ $name }},</p>

    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Leuk dat je je hebt aangemeld voor Julia, je bent slechts enkele stappen verwijderd van handelen op jouw
        online Marktplaats!
    </p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Heb je wat te koop of wil je gewoon zelf even checken wat er te koop wordt aangeboden? Begin dan vandaag nog
        op <a href="https://www.julia.sr/">www.julia.sr</a>
        Voltooi je profiel en je bent ready to go.
    </p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
        Heb je nog vragen check dan onze veel gestelde vragen lijst <a href="{{ url('/faq') }}">FAQs</a> of stuur ons een mailtje via
        <a href="mailto:klantenservice@julia.sr">klantenservice@julia.sr</a>
    </p>
    <p style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #000; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: left;">
            Date: {{ date('d-m-Y') }}
    </p>

    </td>
</tr>

<!-- Email Body  end-->

@include('mails.footer')
