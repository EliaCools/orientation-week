import {TestBed} from '@angular/core/testing';

import {CrudGameService} from './crud-game.service';

describe('CrudGameService', () => {
  let service: CrudGameService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CrudGameService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
