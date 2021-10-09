import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ArchetectureComponent } from './archetecture.component';

describe('ArchetectureComponent', () => {
  let component: ArchetectureComponent;
  let fixture: ComponentFixture<ArchetectureComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ArchetectureComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(ArchetectureComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
