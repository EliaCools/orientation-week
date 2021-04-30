import {Injectable} from '@angular/core';
import {Game} from '../entitys/game';
import {Observable, of} from 'rxjs';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {catchError, map, tap} from 'rxjs/operators';

@Injectable({
  providedIn: 'root'
})
export class CrudGameService {
  private gamesUrl = 'http://symfonyapi.local/index.php/game';

  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      console.error(error); // log to console instead
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  getGames(): Observable<Game[]> {
    return this.http.get<Game[]>(this.gamesUrl).pipe(tap(_ => console.log('fetched games')),
      catchError(this.handleError<Game[]>('getGames', []))
    );
  }

  getGame(id: string): Observable<Game[]> {
    const url = `${this.gamesUrl}/${id}`;
    return this.http.get<Game[]>(url).pipe(tap(_ => console.log('fetched games')),
      catchError(this.handleError<Game[]>('getGames', []))
    );
  }

  addGame(game: Game): Observable<any> {
    return this.http.post<Game>(this.gamesUrl, game);
  }

  editGame(game: Game, id: string): Observable<any> {
    return this.http.put<Game>(this.gamesUrl + '/' + id, game);
  }

  deleteGame(id: string): Observable<any> {
    const url = `${this.gamesUrl}/${id}`;
    return this.http.delete<Game>(url);
  }

  constructor(private http: HttpClient) {

  }
}
