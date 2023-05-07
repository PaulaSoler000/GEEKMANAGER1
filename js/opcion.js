const seleccion = document.getElementById('tipo_objeto');
const edicion = document.getElementById('edicionDiv');
const editorial = document.getElementById('editorialDiv');
const volumen = document.getElementById('volumenDiv');
const autor = document.getElementById('autorDiv');
const genero = document.getElementById('generoDiv');
const compañia = document.getElementById('compañiaDiv');
const plataforma = document.getElementById('plataformaDiv');
const altura = document.getElementById('alturaDiv');
const marca = document.getElementById('marcaDiv');

seleccion.addEventListener('change', function() {
  if (this.value === 'manga') {
    edicion.style.display = '';
    editorial.style.display = '';
    volumen.style.display = '';
    autor.style.display = '';
    genero.style.display = '';
    compañia.style.display = 'none';
    plataforma.style.display = 'none';
    altura.style.display = 'none';
    marca.style.display = 'none';

  } else if (this.value === 'libro') {
    edicion.style.display = '';
    editorial.style.display = '';
    volumen.style.display = '';
    autor.style.display = '';
    genero.style.display = '';
    compañia.style.display = 'none';
    plataforma.style.display = 'none';
    altura.style.display = 'none';
    marca.style.display = 'none';

  } else if (this.value === 'videojuego') {
    edicion.style.display = '';
    editorial.style.display = 'none';
    volumen.style.display = 'none';
    autor.style.display = 'none';
    genero.style.display = '';
    compañia.style.display = '';
    plataforma.style.display = '';
    altura.style.display = 'none';
    marca.style.display = 'none';

  } else if (this.value === 'figura') {
    edicion.style.display = '';
    editorial.style.display = 'none';
    volumen.style.display = 'none';
    autor.style.display = '';
    genero.style.display = 'none';
    compañia.style.display = 'none';
    plataforma.style.display = 'none';
    altura.style.display = '';
    marca.style.display = '';
  }
});

