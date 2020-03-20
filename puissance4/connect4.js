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

  checkForWin(y, x, countY, posx, posy) 
      {
        vert(y, countY, posx);
        horizontal(y, x, countY, posx, posy);
      }

      vert(y, num_y, posx) 
      {
        let vert = 0;
        num_y--;
        let color_data = $("[data-position='"+ num_y +"-"+ posx +"']").find("span").css("background-color");
        for (let countY = num_y; countY < y; countY++) 
        {
          let color_data2 = $("[data-position='"+ countY +"-"+ posx +"']").find("span").css("background-color");
          if (color_data === color_data2) 
          {
            vert++;
            if (vert === 4) 
            {
              playing = !playing;
              win();
              return;
            }
          }
          else 
          {
            return;
          }
        }
      }

      horizontal(y, x, num_y, posx, posy) 
      {
        let horizontal = 0;
        num_y--;
        x = (x - 1);
        let color_dataH = $("[data-position='"+ num_y +"-"+ posx +"']").find("span").css("background-color");
        for (let countX = posx; countX <= x; countX++) 
        {
          let color_data2H = $("[data-position='"+ num_y +"-"+ countX +"']").find("span").css("background-color");
          if (color_dataH === color_data2H) 
          {
            horizontal++;
            cur = $("[data-position='"+ num_y +"-"+ countX +"']").find("span")[0];
            if (horizontal === 4) 
            {
              playing = !playing;
              win();
              return;
            }
            else 
            {
              vertical(countX, num_y);
            }
          }
          else 
          {
            return;
          }
        }
      }

      vertical(num_x, num_y) 
      {
        let vertical = 0;
        let color_dataHplus = $("[data-position='"+ num_y +"-"+ num_x + "']").find("span").css("background-color");
        for (let countX = num_x; countX >= 0; countX--) 
        {
          let color_dataplusplus = $("[data-position='"+ num_y +"-"+ countX +"']").find("span").css("background-color");
          if (color_dataplusplus === color_dataHplus) 
          {
            vertical++;
            if  (vertical === 4) 
            {
              playing = !playing;
              win();
              return;
            }
          }
          else 
          {
            vertical = 0;
            return;
          }
        }
      }

  restart() {
    this.Affichagedujeu();
    this.onJoueurMove();
  }
}

