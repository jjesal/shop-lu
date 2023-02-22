<template>
    <table class="table">
        <thead>
            <tr>
                <th v-for="item in arrHeadKey">{{item.head}}</th>
                <!-- <th scope="col">#</th>
                <th scope="col">Nombre</th> -->
                <th scope="col">Editar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="catagoria in arrItems">
                <td v-for="headKey in arrHeadKey">{{ catagoria[headKey.key] }}</td>
                <!-- <th scope="row">{{ item.id }}</th>
                <td>{{ item.nombre }}</td> -->
                <td>Editar</td>
                <td>Eliminar</td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    name: "listItems",
    props: ['arrItems', 'arrHeadKey']
};
</script>
<style></style>
