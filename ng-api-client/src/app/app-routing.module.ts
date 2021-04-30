import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {PreloadAllModules} from '@angular/router';
import {HomepageComponent} from './homepage/homepage.component';

const routes: Routes = [
  {
    path: 'games',
    loadChildren: () => import('./games/games.module').then(m => m.GamesModule)
  },
  {
    path: 'customers',
    loadChildren: () => import('./customers/customers.module').then(m => m.CustomersModule)
  },
  {
    path: 'homepage', component: HomepageComponent
  },
  {
    path: '',
    redirectTo: 'homepage',
    pathMatch: 'full'
  }];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
