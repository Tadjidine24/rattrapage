$(document).ready(function() {
  const connect4 = new Connect4('#connect4')

  connect4.onJoueurMove = function() {
    $('#joueur').text(connect4.joueur);
  }
  
  $('#restart').click(function() {
    connect4.restart();
  })
});