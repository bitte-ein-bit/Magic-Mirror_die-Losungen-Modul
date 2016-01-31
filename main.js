text = 'lehrtext';

function updateText() {
  $.getJSON( "modules/die-losungen/losung.php", function( data ) {
    $('#losungsvers').html(data.Losungsvers);
    $('#losungstext').html(data.Losungstext);
    $('#lehrtextvers').html(data.Lehrtextvers);
    $('#lehrtext').html(data.Lehrtext);
  });

  var now = new Date();
  var then = new Date(now);
  then.setHours(24,0,0,0);
  var sleep = then - now + 10;
  setTimeout(updateText, sleep);

}

function switchText() {
  if (text == 'lehrtext') {
    $('.lehrtext').fadeOut(1000, function() {
      $('.losung').fadeIn(1000);
    });
    text = 'losung';

  } else {
    $('.losung').fadeOut(1000,function() {
      $('.lehrtext').fadeIn(1000);
    });
    text = 'lehrtext';
  }
}

$().ready(function(){
  switchText();
  updateText();
  setInterval(switchText, 60000);
});