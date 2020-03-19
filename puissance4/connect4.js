class Connect4 {
  constructor(select) {
    this.LIGNES = 6;
    this.COLONNES = 7;
    this.joueur = 'yellow';
    this.select = select;
    this.FinDuJeu = false;
    this.onJoueurMove = function () { };
    this.Affichagedujeu();
    this.setupEventListeners();
    this.nbrT = 0;
    // console.log("azziz")
  }

  Affichagedujeu() {
    const $board = $(this.select);
    this.FinDuJeu = false;
    $board.empty();


    for (let ln = 0; ln < this.LIGNES; ln++) {
      const $ln = $('<div>').addClass('ln');

      for (let col = 0; col < this.COLONNES; col++) {
        const $col = $('<div>').addClass('col empty').attr('data-col', col).attr('data-ln', ln);
        $ln.append($col);
      }
      $board.append($ln);
    }
  }

  //   setupEventListeners()
  //   {
  //     let that = this
  //      $(".col").on("click", function(event){
  //      this.$nbrT++;
  //     // event.target.style.backgroundColor = 'yellow';
  //       console.log(that.COLONNES);
  //        for (let col = that.COLONNES-1; col > 0; col--)
  //        {
  //          console.log("POL")
  //        // if ('col empty') {
  //         $("[data-col = 1][data-ln = 1]")[0].style.backgroundColor = "yellow";
  //        // }
  //        }
  //      //      console.log(event.target);
  //     }); 
  //   }


  //   restart()
  //   {
  //     this.Affichagedujeu();
  //     this.onJoueurMove();
  //   }
  // }

  setupEventListeners() {
    const $board = $(this.select);
    const that = this;

    function DerniereColVide(col) {
      const cells = $(`.col[data-col='${col}']`);
      for (let i = cells.length - 1; i >= 0; i--) {
        const $cell = $(cells[i]);
        if ($cell.hasClass('empty')) {
          return $cell;
        }
      }
      return null;
    }

    $board.on('mouseenter', '.col.empty', function () {
      if (that.FinDuJeu) {
        return;
      }
      const col = $(this).data('col');
      const $DerniereColVide = DerniereColVide(col);
      $DerniereColVide.addClass(`next-${that.joueur}`);
    });

    $board.on('mouseleave', '.col', function () {
      $('.col').removeClass(`next-${that.joueur}`);
    });

    $board.on('click', '.col.empty', function () {

      // if (that.joueur === 'yellow'){
      //   that.joueur === 'black';
      // }
      // else{
      //   that.joueur === 'yellow';
      // }

      that.joueur = (that.joueur === 'yellow') ? 'black' : 'yellow';
      that.onJoueurMove();
      $(this).trigger('mouseenter');

      const col = $(this).data('col');
      const $DerniereColVide = DerniereColVide(col);
      $DerniereColVide.removeClass(`empty next-${that.joueur}`).addClass(that.joueur).data('joueur', that.joueur);
    });
  }

  restart() {
    this.Affichagedujeu();
    this.onJoueurMove();
  }
}

