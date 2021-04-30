import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';

import {GamesRoutingModule} from './games-routing.module';
import {GamesComponent} from './games.component';
import {FormAddGameComponent} from './form-add-game/form-add-game.component';
import {FormsModule} from '@angular/forms';
import {EditGameComponent} from './edit-game/edit-game.component';


@NgModule({
  declarations: [
    GamesComponent,
    FormAddGameComponent,
    EditGameComponent
  ],
  imports: [
    CommonModule,
    GamesRoutingModule,
    FormsModule
  ]
})
export class GamesModule {
}
