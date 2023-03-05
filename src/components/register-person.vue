<template>
    <form id="regist-form" @submit="register">
        <label>Registro de usuarios</label>
        <input v-model="persona.nombres" placeholder="Nombres" required />
        <input v-model="persona.apellidos" placeholder="Apellidos" required />
        <input v-model="persona.dni" type="number" placeholder="DNI" maxlength="8" required />
        <input v-model="persona.celular" type="number" placeholder="Celular" maxlength="9" required />
        <input v-model="persona.direccion" placeholder="Direccion" type="text" required />
        <input v-model="persona.correo" placeholder="Correo electrónico" type="email" required />
        <input v-model="persona.password" placeholder="Contraseña" type="password" required />
        <div v-if="showRol" class="form-group">
            <label for="select_category">Rol</label>
            <select @change="updateRol($event)" v-model="persona.rol_id" name="rol_id" required class="form-control"
                id="select_category">
                <option v-for="rol in arrRol" :value="rol.id">
                    {{ rol.nombre_rol }}
                </option>
            </select>
        </div>
        <input class="my-btn" type="submit" value="Enviar">
    </form>
</template>
<script>


export default {
    name: 'registerPerson',
    props: ['rolId', 'showRol'],
    components: {
    },
    data: () => {
        return {
            persona: {
                id: 'NULL',
                rol_id: '3'
            },
            arrRol: [],
        };
    },
    created: function () {
        if (this.rolId) {
            this.persona.rol_id = this.rolId;
        } else {
            this.listarRol();
            this.persona.rol_id = 2;
        }
    },
    methods: {
        updateRol(event) {
            console.log('updateRol event', event);
            this.persona.rol_id = event.target.value;
        },
        validate() {
            //borra espacios en blanco
            this.user.acc.trim();
            this.user.pass.trim();
            console.log("user: ", this.user.acc, ", pass: ", this.user.pass);
            this.login();
        },
        register(e) {
            e.preventDefault();
            this.$root.postData('insertarPersonal', { persona: this.persona })
                .then(() => {
                    document.querySelector('#regist-form').reset();
                    this.$emit('evt-reload-list');
                    if (!this.showRol) {
                        this.$root.navigate('login')
                    }
                })
                .catch(function () { })
        },
        listarRol() {
            this.$root.getData('listarRol').then(arrRol => {
                this.arrRol = arrRol;
            });
        }
    }
}
</script>

<style scoped>
form {
    display: grid;
    margin: auto;
    align-self: center;
    gap: 1rem;
    justify-content: center;
    text-align: center;
    font-size: 1.2rem;
}

form>label {
    font-size: 45px;
}

form>input {
    border: 1px solid gainsboro
}

.my-btn {
    /* --my-btn-color: white;
    --my-text-color: rgb(234, 53, 84); */
    margin: 0 30px;
}
</style>