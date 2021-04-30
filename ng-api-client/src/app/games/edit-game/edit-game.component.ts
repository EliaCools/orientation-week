import {Component, OnInit} from '@angular/core';
import {Game} from '../../entitys/game';
import {CrudGameService} from '../../services/crud-game.service';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-edit-game',
  templateUrl: './edit-game.component.html',
  styleUrls: ['./edit-game.component.scss']
})
export class EditGameComponent implements OnInit {
  gameModel = new Game(null, null, null, null, undefined, null);
  id;
  singleGame;
  formatdate;
  message;

  constructor(private CrudGamesService: CrudGameService, private route: ActivatedRoute) {
  }

  editGame(id): void {
    this.CrudGamesService.editGame(this.gameModel, id).subscribe(succes => this.message = 'Game added',
      error => console.log('it did not work'));
    setTimeout(() => {
      this.message = ' ';
    }, 2000);
  }

  getGame(id): void {
    this.CrudGamesService.getGame(id).subscribe(game => this.singleGame = game);
  }

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.id = params['id'];
    });
    this.getGame(this.id);
    this.formatdate = this.singleGame?.releasedate.substr(0, 10);
  }

}
