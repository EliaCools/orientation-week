import {Component, OnInit} from '@angular/core';
import {Game} from '../entitys/game';
import {CrudGameService} from '../services/crud-game.service';
import {FormAddGameComponent} from './form-add-game/form-add-game.component';


@Component({
  selector: 'app-games',
  templateUrl: './games.component.html',
  styleUrls: ['./games.component.scss']
})
export class GamesComponent implements OnInit {
  constructor(private CrudGamesService: CrudGameService) {
  }

  gameModel = new Game(null, null, null, null, null, null);
  allGames: Game [] = [];
  singleGame;

  id;

  getGames(): void {
    this.CrudGamesService.getGames()
      .subscribe(games => this.allGames = games);
  }

  getGame(id): void {
    this.CrudGamesService.getGame(id)
      .subscribe(game => this.singleGame = game);
  }

  deleteGame(id: string): void {
    this.CrudGamesService.deleteGame(id)
      .subscribe(succes => this.getGames());
  }

  ngOnInit(): void {
    this.getGames();

  }

}
