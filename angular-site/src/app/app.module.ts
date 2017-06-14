import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { TopComponent } from './template/top.component';
import { SideNavComponent} from './template/side-nav.component';

@NgModule({
  declarations: [
    AppComponent,
    TopComponent,
    SideNavComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule
  ],
  providers: [],
  bootstrap: [
    AppComponent, TopComponent,
    SideNavComponent
  ]
})
export class AppModule { }
