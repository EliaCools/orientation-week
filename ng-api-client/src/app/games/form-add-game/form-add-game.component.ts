import {Component, OnInit, Input} from '@angular/core';
import {Game} from '../../entitys/game';
import {CrudGameService} from '../../services/crud-game.service';
import {Router, ActivatedRoute, ParamMap} from '@angular/router';

@Component({
  selector: 'app-form-add-game',
  templateUrl: './form-add-game.component.html',
  styleUrls: ['./form-add-game.component.scss']
})
export class FormAddGameComponent implements OnInit {
  id;
  message;

  constructor(private CrudGamesService: CrudGameService, private route: ActivatedRoute) {
  }

  gameModel = new Game(null, null, null, null, undefined, null);

  addGame(): void {
    this.CrudGamesService.addGame(this.gameModel).subscribe(succes => this.message = 'Game added',
      error => console.log('it did not work'));
    setTimeout(() => {
      this.message = ' ';
    }, 2000);
  }

  ngOnInit(): void {
    this.route.queryParams.subscribe(params => {
      this.id = params['id'];
    });
  }

}
