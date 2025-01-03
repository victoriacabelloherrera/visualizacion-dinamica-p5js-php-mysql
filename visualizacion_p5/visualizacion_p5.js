let data = []; 
let url = 'http://localhost/cabello_herrera_final/obtener_registros.php'; 
let isDataLoaded = false; 
let mensajeError = ''; 
let frases = []; 
let frameCounter = 0; 
let margen = 50; 
let velocidadEscritura = 8;
let fraseActual = 0; 
let particulas = []; 

function setup() {
  createCanvas(windowWidth, windowHeight);
  loadJSON(url, cargarDatos, manejoError);
}

function cargarDatos(datos) {
  for (let item of datos) {
    const frase = `${item.concepto_celular} ${item.concepto_bateria} ${item.concepto_mes}`;
    frases.push({
      texto: frase, 
      x: random(margen, width - margen - textWidth(frase)), 
      y: random(margen, height - margen), 
      index: 0 
    });
  }
  isDataLoaded = true; 
}

function manejoError(error) {
  mensajeError = 'Error al cargar los datos desde el servidor.';
  console.error(error);
}

function draw() {
  background(230, 10); 

  // dibuja las particulas, se agregan las nuevas particulas al array particula
  if (random() < 0.1) { 
    particulas.push(new Particula());
  }
  for (let i = particulas.length - 1; i >= 0; i--) {
    particulas[i].update();// se actualiza
    particulas[i].display();// se dibuja
    if (particulas[i].alpha <= 0) {
      particulas.splice(i, 1);
    }
  }


  if (!isDataLoaded) {
    fill(0);
    textSize(24);
    textAlign(CENTER, CENTER);
    text("Cargando datos...", width / 2, height / 2);
    if (mensajeError) {
      textSize(16);
      text(mensajeError, width / 2, height / 2 + 30);
    }
    return;
  }



for (let i = 0; i <= fraseActual; i++) {
  let frase = frases[i];
  

  if (frase.index < frase.texto.length) {
    frase.index += velocidadEscritura / 60;
  }

  // se dibuja la frase escrita
  let textoMostrado = frase.texto.slice(0, Math.floor(frase.index));
  fill(0);
  textSize(16);
  textAlign(LEFT, CENTER);
  text(textoMostrado, frase.x, frase.y);
}


if (frases[fraseActual].index >= frases[fraseActual].texto.length && fraseActual < frases.length - 1) {
  fraseActual++;
  }
}

// configuracion de particulas
class Particula {
  constructor() {
    this.x = random(width);
    this.y = random(height);
    this.vx = random(-2, 2);
    this.vy = random(-2, 2);
    this.alpha = 255;
    this.size = random(3, 7);
  }

  update() {
    this.x += this.vx;
    this.y += this.vy;
    this.alpha -= 2; 
  }

  display() {
    noStroke();
    fill(0, this.alpha); 
    ellipse(this.x, this.y, this.size, this.size);
  }
}
