var losungen = {
  text: 'lehrtext',
  textSwitchInterval: 60000,
  intervalId: null,
}

losungen.updateText = function() {
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
  setTimeout(this.updateText, sleep);
}

losungen.switchText = function() {
  if (this.text == 'lehrtext') {
    $('.lehrtext').fadeOut(1000, function() {
      $('.losung').fadeIn(1000);
    });
    this.text = 'losung';

  } else {
    $('.losung').fadeOut(1000,function() {
      $('.lehrtext').fadeIn(1000);
    });
    this.text = 'lehrtext';
  }
}

losungen.init = function() {
  this.switchText();
  this.updateText();
  this.intervalId = setInterval(function () {
    this.switchText();
  }.bind(this), this.textSwitchInterval);
}

$().ready(function(){
  losungen.init();
});