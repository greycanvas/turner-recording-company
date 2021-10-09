import { Component, OnInit } from '@angular/core';
declare const updateCanvas2: any;

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  home="Home One";
  constructor() { }

  ngOnInit(): void {
  }

  clickHomeUpdate(){
    updateCanvas2();
  }
}
