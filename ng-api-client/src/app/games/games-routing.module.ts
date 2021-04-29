import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { GamesComponent } from './games.component';
import { FormAddGameComponent} from './form-add-game/form-add-game.component';
import {EditGameComponent} from './edit-game/edit-game.component';

const routes: Routes = [
  { path: '', component: GamesComponent
  },
  {
    path: 'new-game', component: FormAddGameComponent
  },
  {
    path: 'edit-game', component: EditGameComponent
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class GamesRoutingModule { }
