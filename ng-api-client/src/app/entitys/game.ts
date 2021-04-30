export class Game {
  id;
  name;
  releasedate;
  developer;
  genre;
  image;

  constructor(name: null | string, releasedate: null | string, developer: null | string,
              genre: null | string, id: null | string, image: null | string) {
    this.name = name;
    this.releasedate = releasedate;
    this.developer = developer;
    this.genre = genre;
    this.id = id;
    this.image = image;
  }

}
