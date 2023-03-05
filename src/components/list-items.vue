<template>
    <table class="table">
        <thead>
            <tr>
                <th v-for="item in arrHeadKey">{{ item.head }}</th>
                <!-- <th scope="col">#</th>
                <th scope="col">Nombre</th> -->

            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in arrItems" :key="index">
                <td v-for="headKey in arrHeadKey">{{ headKey.hasOwnProperty('computeFx') ? headKey.computeFx(item) :
                    item[headKey.key] }}</td>
                <td v-for="button in arrButtons"><button class="my-btn"
                        :disabled="button.hasOwnProperty('disabledFx') ? ($root.userLogged.rol_id === 1 ? false : button.disabledFx(item)) : false"
                        @click="$emit(button.event, index)">{{ button.name }}</button></td>
                <!-- <th scope="row">{{ item.id }}</th>
                <td>{{ item.nombre }}</td> -->
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    name: "listItems",
    props: {
        arrItems: {
            type: Array,
            default: function () {
                return []
            }
        },
        arrHeadKey: {
            type: Array,
            default: function () {
                return []
            }
        },
        arrButtons: {
            type: Array,
            default: function () {
                return [
                    { name: 'Editar', event: 'evt-editar' },
                    { name: 'Eliminar', event: 'evt-eliminar' }
                ]
            }
        }
    },
    created: function () {
        // this.arrButtons = [
        //     { name: 'Editar', event: 'evt-editar' },
        //     { name: 'Eliminar', event: 'evt-eliminar' }
        // ];
    }
};
</script>
<style></style>
