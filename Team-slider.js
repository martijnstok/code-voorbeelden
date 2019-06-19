/* 
 *
 * Auteur: Martijn Stok
 * Functie: Teamfoto Slider op de homepage van Mad Pack
 * 
 * Versie: 2.0
 *
 * libraries: Jquery & Jquery UI
 * 
 */
$(document).ready(function() {
   if ($('.teamfoto').length > 0) {

      //maak teamfoto 'draggable'
      $(".teamfoto-brother").draggable({
         axis: "x",
         drag: function(event, ui) {
            var left = ui.position.left,
               offsetWidth = ($(this).width() - $(this).parent().width()) * -1;
            if (left > 0) {
               ui.position.left = 0
            }
            if (offsetWidth > left) {
               ui.position.left = offsetWidth
            }
         }
      });

      //Loop 13x, maak divjes in de 'teamfoto-brother'
      //Deze divs zijn om de hovers locaties te bepalen op de teamfoto
      for (i = 0; i < 13; i++) {
         $('.teamfoto-brother').append("<div></div>")
      }

      //nog wat divjes maken
      $('.teamfoto-brother').append("<div class='clear'></div>");
      $('.teamfoto-brother').append("<div class='teamfoto-hover'></div>");

      //Bepaal variablen voor berekening
      var teamfoto = $('.teamfoto-hover').width();
      var beedlscherm = $(window).width();
      var slideleft = teamfoto - beedlscherm;
      var slide = !0;

      //roep functie aan
      slide_teamfoto();

      //Maak Recursie functie aan
      function slide_teamfoto() {
         //Bepaal de snelheid hoe de foto heen en weer gaat
         var speed1 = (slideleft + parseInt($(".teamfoto-brother").css('left'))) * 20;
         var speed2 = (slideleft - parseInt($(".teamfoto-brother").css('left'))) * 10;


         if (slide) {
            //Ga naar rechts
            $(".teamfoto-brother").animate({
               left: "-" + slideleft,
            }, speed1, function() {
               //zet variable op !1
               slide = !1;

               //Roep zelf aan
               slide_teamfoto()
            })
         } else {
            //Ga naar links
            $(".teamfoto-brother").animate({
               left: "0",
            }, speed2, function() {
               //zet variable op !0 
               slide = !0;

               //Roep zelf aan
               slide_teamfoto()
            })
         }
      }

      // Wanneer muis hover over een div binnen 'teamfoto-brother'
      $(".teamfoto-brother div").mouseenter(function() {
         //Maak vars aan
         var hover = $(this);
         var geselecteerd = "";
         var bg_url = "";
         var personen = ["Audrey", "Martijn", "Martin", "Mohamed", "Manouk", "Nicole", "Colin", "Rick", "Michiel", "Cesar", "Luuk", "Ashvith", "Kevin"];

         //Stop de animatie
         $(".teamfoto-brother").stop();

         //Verwijder de 'meet the pack zin'
         $('section.meet-the-pack .container div.active').css('display', 'none');
         $('section.meet-the-pack .container div.active').removeClass('active');

         //Kijk over wie er word geselecteerd
         $.each(personen, function(index, value) {
            //Als de index van het array-item gelijk is aan de index van de hover
            if (index == hover.index()) {
               //Sla naam op
               geselecteerd = value;
            }
         });

         bg_url = 'url(inc/img/backgrounds/overons/' + geselecteerd.toLowerCase() + '-hover.jpg)';

         //Als er niet gehoverd word op een van de divs
         if (geselecteerd == "") {
            //Pas achtergrond aan waardoor de rest van de peronen grijs worden
            $(' .teamfoto-hover ').css('background-image', 'url(inc/img/home/overons/overons.jpg)');

            //zorg dat de plek van 'meet the pack' verranderd
            $('.standard').css('display', 'block');
            $('.standard').addClass('active');
         } else {
            //Pas achtergrond aan waardoor de iedeeren naar voren komt
            $(' .teamfoto-hover ').css('background-image', bg_url);

            //zorg dat de plek van 'meet the pack' verranderd
            $('.' + geselecteerd).css('display', 'block');
            $('.' + geselecteerd).addClass('active');
         }
      });

      //Wanneer je weg gaat met de muis van de foto (en alleen op groot formaat)
      if ($(window).width() > 876) {
         $(".teamfoto-brother").mouseleave(function() {
            //Roep functie aan voor animeren
            slide_teamfoto();

            //Reset alles weer naar standaard instellingen
            $('section.meet-the-pack .container div.active').css('display', 'none');
            $('section.meet-the-pack .container div.active').removeClass('active');
            $(' .teamfoto-hover ').css('background-image', 'url(inc/img/home/overons/overons.jpg)');
            $('.standard').addClass('active');
            $('.standard').css('display', 'block')
         })
      }
   }
});
