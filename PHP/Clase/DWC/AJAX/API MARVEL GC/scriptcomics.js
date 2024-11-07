const publicKey = "46e91089b1bf864c8173726097219773";
const privateKey = "3cfd594f033ea41d3880dacd8761d2db297500e1";
const base = "https://gateway.marvel.com/v1/public/comics";

let offset = 0;
let limit = 20;

const generateAuthParams = () => {
    const ts = Date.now().toString();
    const hash = CryptoJS.MD5(ts + privateKey + publicKey).toString();
    return `ts=${ts}&apikey=${publicKey}&hash=${hash}`;
};

window.onload = () => {
    createTable();

    document.getElementById('buscar').onkeydown = (e) => {
        if (e.keyCode === 13) searchComic(e.target.value);
    };

    document.getElementById('limite').onchange = function () {
        limit = parseInt(this.value);
        offset = 0;
        showAllComics();
    };

    document.getElementById('anterior').onclick = () => {
        offset -= limit;
        showAllComics();
    };

    document.getElementById('siguiente').onclick = () => {
        offset += limit;
        showAllComics();
    };

    showAllComics();
};

const createTable = () => {
    const table = document.createElement('table');
    table.className = 'tabla-estilizada';

    const header = table.createTHead();
    const headerRow = header.insertRow(0);
    const headers = ['Imagen', 'Nombre', 'ISBN', 'Descripción'];

    headers.forEach((text, index) => {
        const cell = headerRow.insertCell(index);
        cell.innerHTML = `<b>${text}</b>`;
    });

    const body = table.createTBody();
    table.id = 'tablaComics';
    document.body.insertBefore(table, document.body.firstChild);
};

const searchComic = (title) => {
    deleteComics();
    const authParams = generateAuthParams();
    fetch(`${base}?title=${title}&${authParams}`)
        .then(response => response.json())
        .then(datos => {
            const comic = datos.data.results[0];
            if (comic) {
                createRow(
                    `${comic.thumbnail.path}.${comic.thumbnail.extension}`,
                    comic.title,
                    comic.isbn || 'No ISBN disponible',
                    comic.description || 'No description available',
                    comic
                );
            } else {
                alert("Comic no encontrado");
            }
        })
        .catch(error => console.error('Error al obtener datos:', error));
};

const showAllComics = () => {
    deleteComics();
    const authParams = generateAuthParams();
    fetch(`${base}?limit=${limit}&offset=${offset}&${authParams}`)
        .then(response => response.json())
        .then(datos => {
            datos.data.results.forEach(comic => {
                createRow(
                    `${comic.thumbnail.path}.${comic.thumbnail.extension}`,
                    comic.title,
                    comic.isbn || 'No ISBN disponible',
                    comic.description || 'No description available',
                    comic
                );
            });
        })
        .catch(error => console.error('Error al obtener datos:', error));
    document.getElementById('anterior').disabled = offset < limit;
    document.getElementById('siguiente').disabled = offset > 1399;
};

const createRow = (img, title, isbn, description, comic) => {
    const table = document.getElementById('tablaComics').getElementsByTagName('tbody')[0];
    const row = table.insertRow();

    const imgCell = row.insertCell(0);
    const titleCell = row.insertCell(1);
    const isbnCell = row.insertCell(2);
    const descCell = row.insertCell(3);

    const imgElement = document.createElement('img');
    imgElement.src = img;
    imgElement.style.width = '100px';
    imgCell.appendChild(imgElement);

    titleCell.innerHTML = title;
    isbnCell.innerHTML = isbn;
    descCell.innerHTML = description;

    row.onclick = () => displayComicDetail(comic);
};

const deleteComics = () => {
    const table = document.getElementById('tablaComics').getElementsByTagName('tbody')[0];
    while (table.rows.length > 0) {
        table.deleteRow(0);
    }
};

const displayComicDetail = (comic) => {
    const detailContainer = document.getElementById('detalleComic');
    detailContainer.style.display = 'block';

    detailContainer.innerHTML = `
        <img src="${comic.thumbnail.path}.${comic.thumbnail.extension}" alt="${comic.title}" />
        <h2>${comic.title}</h2>
        <p>ISBN: ${comic.isbn || "No ISBN disponible"}</p>
        <p>Descripción: ${comic.description || "No description available"}</p>
    `;
};
