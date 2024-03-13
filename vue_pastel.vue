<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Pastelitos</title>
    <link rel="stylesheet" href="crudphp_pastel.php">

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    <div id="app">
        <h2>CRUD de Pastel</h2>
        <form @submit.prevent="addItem">
            <input type="text" v-model="newItem.name" placeholder="Nombre del pastel" required>
            <input type="number" v-model="newItem.price" placeholder="Precio" required>
            <button type="submit">Agregar Pastelito</button>
        </form>
        <ul>
            <li v-for="item in items">
                <span>{{ item.name }} - ${{ item.price }}</span>
                <button @click="editItem(item)">Editar</button>
                <button @click="deleteItem(item.id)">Eliminar</button>
            </li>
        </ul>
        <div v-if="editing">
            <h3>Completando Pastel</h3>
            <form @submit.prevent="updateItem">
                <input type="text" v-model="editedItem.name" required>
                <input type="number" v-model="editedItem.price" required>
                <button type="submit">Guardar Cambios</button>
                <button @click="cancelEdit">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                items: [],
                newItem: {
                    name: '',
                    price: 0
                },
                editing: false,
                editedItem: {
                    id: null,
                    name: '',
                    price: 0
                }
            },
            mounted() {
                this.getItems();
            },
            methods: {
                getItems() {
                    axios.get('/api/items')
                        .then(response => {
                            this.items = response.data;
                        })
                        .catch(error => {
                            console.error('Error fetching items:', error);
                        });
                },
                addItem() {
                    axios.post('/api/items', this.newItem)
                        .then(response => {
                            this.newItem.name = '';
                            this.newItem.price = 0;
                            this.getItems();
                        })
                        .catch(error => {
                            console.error('Error adding item:', error);
                        });
                },
                editItem(item) {
                    this.editing = true;
                    this.editedItem.id = item.id;
                    this.editedItem.name = item.name;
                    this.editedItem.price = item.price;
                },
                updateItem() {
                    axios.put('/api/items/' + this.editedItem.id, this.editedItem)
                        .then(response => {
                            this.editing = false;
                            this.editedItem.id = null;
                            this.editedItem.name = '';
                            this.editedItem.price = 0;
                            this.getItems();
                        })
                        .catch(error => {
                            console.error('Error updating item:', error);
                        });
                },
                cancelEdit() {
                    this.editing = false;
                    this.editedItem.id = null;
                    this.editedItem.name = '';
                    this.editedItem.price = 0;
                },
                deleteItem(id) {
                    axios.delete('/api/items/' + id)
                        .then(response => {
                            this.getItems();
                        })
                        .catch(error => {
                            console.error('Error deleting item:', error);
                        });
                }
            }
        });
    </script>
</body>
</html>
