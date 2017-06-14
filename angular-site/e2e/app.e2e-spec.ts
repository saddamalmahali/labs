import { AngularSitePage } from './app.po';

describe('angular-site App', () => {
  let page: AngularSitePage;

  beforeEach(() => {
    page = new AngularSitePage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
