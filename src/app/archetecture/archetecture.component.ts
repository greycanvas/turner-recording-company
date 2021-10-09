import { Component, OnInit } from '@angular/core';
declare const updateCanvas: any;

@Component({
  selector: 'app-archetecture',
  templateUrl: './archetecture.component.html',
  styleUrls: ['./archetecture.component.scss']
})
export class ArchetectureComponent implements OnInit {

  archetect = 'Building One';
  constructor() { }

  ngOnInit(): void {

  }

  updateDraw(){
    updateCanvas();
  }
}
