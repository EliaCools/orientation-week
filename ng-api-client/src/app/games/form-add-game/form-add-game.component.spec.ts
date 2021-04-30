import {ComponentFixture, TestBed} from '@angular/core/testing';

import {FormAddGameComponent} from './form-add-game.component';

describe('FormAddGameComponent', () => {
  let component: FormAddGameComponent;
  let fixture: ComponentFixture<FormAddGameComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FormAddGameComponent]
    })
      .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FormAddGameComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
