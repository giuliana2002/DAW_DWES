const publicKey = "46e91089b1bf864c8173726097219773";
const privateKey = "3cfd594f033ea41d3880dacd8761d2db297500e1";
const base = "https://gateway.marvel.com/v1/public/characters";

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
        if (e.keyCode === 13) searchCharacter(e.target.value);
    };

    document.getElementById('limite').onchange = function () {
        limit = parseInt(this.value);
        offset = 0;
        showAllCharacter();
    };

    document.getElementById('anterior').onclick = () => {
        offset -= limit;
        showAllCharacter();
    };

    document.getElementById('siguiente').onclick = () => {
        offset += limit;
        showAllCharacter();
    };

    showAllCharacter();
};

const createTable = () => {
    const table = document.createElement('table');
    table.className = 'tabla-estilizada';

    const header = table.createTHead();
    const headerRow = header.insertRow(0);
    const headers = ['Imagen', 'Nombre', 'Descripción'];

    headers.forEach((text, index) => {
        const cell = headerRow.insertCell(index);
        cell.innerHTML = `<b>${text}</b>`;
    });

    const body = table.createTBody();
    table.id = 'tablaPersonajes';
    document.body.insertBefore(table, document.body.firstChild);
};

const searchCharacter = (name) => {
    deleteCharacter();
    const authParams = generateAuthParams();
    fetch(`${base}?name=${name}&${authParams}`)
        .then(response => response.json())
        .then(datos => {
            const character = datos.data.results[0];
            createRow(`${character.thumbnail.path}.${character.thumbnail.extension}`, character.name, character.description, character);
        })
        .catch(error => console.error('Error al obtener datos:', error));
};

const showAllCharacter = () => {
    deleteCharacter();
    const authParams = generateAuthParams();
    fetch(`${base}?limit=${limit}&offset=${offset}&${authParams}`)
        .then(response => response.json())
        .then(datos => {
            datos.data.results.forEach(character => {
                createRow(`${character.thumbnail.path}.${character.thumbnail.extension}`, character.name, character.description, character);
            });
        })
        .catch(error => console.error('Error al obtener datos:', error));

    document.getElementById('anterior').disabled = offset < limit;
    document.getElementById('siguiente').disabled = offset > 1399;
};

const createRow = (img, name, description, character) => {
    const table = document.getElementById('tablaPersonajes').getElementsByTagName('tbody')[0];
    const row = table.insertRow();

    const imgCell = row.insertCell(0);
    const nameCell = row.insertCell(1);
    const descriptionCell = row.insertCell(2);

    const imgElement = document.createElement('img');
    imgElement.src = img;
    imgElement.style.width = '100px';
    imgCell.appendChild(imgElement);

    nameCell.innerHTML = name;
    descriptionCell.innerHTML = description ? maxCaract(description, 190) : 'No hay descripción disponible';

    row.onclick = () => displayCharacterDetail(character);
};

const deleteCharacter = () => {
    const table = document.getElementById('tablaPersonajes').getElementsByTagName('tbody')[0];
    while (table.rows.length > 0) {
        table.deleteRow(0);
    }
};

const maxCaract = (text, max) => {
    return text.length > max ? text.substring(0, max) + "..." : text;
};

const displayCharacterDetail = (character) => {
    const detailContainer = document.getElementById('detallePersonaje');
    detailContainer.style.display = 'block';

    detailContainer.innerHTML = `
        <img src="${character.thumbnail.path}.${character.thumbnail.extension}" alt="${character.name}" />
        <h2>${character.name}</h2>
        <p>${character.description || "No hay descripción disponible"}</p>
    `;
};
