const connection = new JsStore.Connection(new Worker("jsstore/jsstore.worker.min.js"));

const database = {
    name: "PersonaDB",
    tables: [
        {
            name: "Personas",
            columns: {
                id: { primaryKey: true, autoIncrement: true },
                dni: { notNull: true, dataType: "string" },
                nombre: { notNull: true, dataType: "string" },
                apellidos: { dataType: "string", default: "" },
                fnacimiento: { notNull: true, dataType: "date_time" },
                estatura: { dataType: "number" },
                imagen: { dataType: "string" },
                estado_civil: { dataType: "string" }
            }
        }
    ]
};

async function initDB() {
    try {
        const isDbCreated = await connection.initDb(database);
        console.log(isDbCreated ? "Database created" : "Database opened");
    } catch (error) {
        console.error("Error initializing database", error);
    }
}

initDB();

async function insertPersona(persona) {
    const result = await connection.insert({
        into: "Personas",
        values: [persona]
    });
    return result;
}

async function getAllPersonas() {
    return await connection.select({
        from: "Personas"
    });
}

async function updatePersona(id, updateData) {
    const result = await connection.update({
        in: "Personas",
        set: updateData,
        where: { id }
    });
    return result;
}

async function deletePersona(id) {
    const result = await connection.remove({
        from: "Personas",
        where: { id }
    });
    return result;
}

export { insertPersona, getAllPersonas, updatePersona, deletePersona };