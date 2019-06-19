//Wanner submit
$('.kaartje form').submit(function(event) {

   //Hou submit tegen
   event.preventDefault();

   //is recaptcha geladen
   grecaptcha.ready(function() {

      //Vraag recaptcha response
      grecaptcha.execute('6LdVVpsUAAAAAPsdv9UlozFRCUY0GgBaS4mQK9Co', {
         action: 'send_form'
      }).then(function(token) {

         //recaptia respons heb je nu, stop deze in hidden field
         $('.kaartje form').append('<input type="hidden" name="g-recaptcha-response" value="' + token + '">');

         //Vraag alle data in form op
         var formData = $('.kaartje form').serialize();

         //Geef de form data door via ajax naar een mail functie in php
         $.ajax({
            type: 'POST',
            url: $('.kaartje form').attr('action'),
            data: formData
         }).done(function(response) {
            //Gelukt! mail verstuurd
            $('.kaartje #form-messages').text(data.responseText);
         }).fail(function(data) {
            //iets is niet gelukt! mail niet verstuurd
            $('.kaartje #form-messages').text(data.responseText);
         });

      });
   });
});