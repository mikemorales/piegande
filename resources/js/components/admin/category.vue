<template>
    <div id="category-component">
        <div class="container">
            <div id="barraSec" class="row padFixBoth">

                <div class="col-12 col-sm-12 nopadding">
                    <h1 class="secTitle">CATEGORY</h1>
                </div>

            </div>
            <main id="mainContent" class="padFixBoth">

                <form id="" class="animated fadeIn margin-al-inputs formCategory">
                    <div class="row">

                        <div class="col-4">
                            <input type="text" class="al-inputs required" v-model="category.name" placeholder="Nombre de la Categoria" id="">
                        </div>

                        <div class="col-4">
                            <select data-select="on" class="required" data-name-input="Status Categoria" name="status_event" v-model="category.status" id="status_agente">
                                <option :value="0">Status del Categoria</option>
                                <option :value="1">Inactiva</option>
                                <option :value="2">Activa</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button type="button" class="formSubmit" v-on:click="onSave()">{{ tituloBtn }}</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <DataTable id="guest_table" :columns="columns" :data="listCategories" :options="dataTableOptions" ref="table" class="table table-hover table-striped view" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Acciones</th>
                        </tr>
                        </tfoot>
                    </DataTable>
                </div>
            </main>
        </div>

    </div>
</template>
<script setup>
import {onMounted,ref} from 'vue';
import {categoryService} from '../Services/Category.service';
import {useMixin} from '../mixins/useMixin';

import Buttons from 'datatables.net-buttons';
import jszip from 'jszip';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import DataTable from 'datatables.net-vue3';
import DataTableBs5 from 'datatables.net-bs5';
import $ from "jquery";

DataTable.use(Buttons);
DataTable.use(jszip);
DataTable.use(ButtonsHtml5);
DataTable.use(DataTableBs5);

window.JSZip = jszip;
//ESTADOS
const tituloBtn = ref('Agregar');
const listCategories = ref([]);
const modificar = ref(false);
const category = ref({
    id: '',
    name: '',
    status: 0,
});
const columns = ref([
    {data: 'name'},
    {
        data: 'status',
        render: function (data, type, row) {
            if (data === 1) {
                return '<span class="badge rounded-pill text-bg-warning">Inactiva</span>';
            } else if (data === 2) {
                return '<span class="badge rounded-pill text-bg-success">Activa</span>';
            }
        }
    },
    {
        data: 'acciones',
        wrap: true,
        render: function (data, type, row) {
            let buttons = '<button data-item-id="' + row.id + '" data-item-name="' + row.name + '" data-item-status="' + row.status + '" class="edit btn btn-warning btn-xs btn-flat edit-item">Edit</button>'
            buttons += '<button class="delete btn btn-danger btn-xs btn-flat delete-item" data-item-id="' + row.id + '">Delete</button>'
            return buttons;
        },

    }
]);
const dataTableOptions = ref({
    responsive: true,
    autoWidth: false,
    destroy: true,
    deferRender: true,
    dom: '"<\'row\'<\'col-sm-8\'B><\'col-sm-4 mb-3\'f>>" +\n' +
        '"<\'row\'<\'col-sm-12\'tr>>" +\n' +
        '"<\'row\'<\'col-sm-5\'i><\'col-sm-7\'p>>"',
    buttons: [
        {extend: 'copy', text: 'Copiar', className: 'btn btn-success'},
        {extend: 'excel', text: 'Exportar a Excel', className: 'btn btn-warning'},
    ],
    "oLanguage": {
        "sSearch": "Buscar",
        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
    },
    "language": {
        "paginate": {
            "previous": "Anterior",
            "next": "Siguiente",
        }
    },
    "drawCallback": function () {
        $(".edit-item").on('click', function (e) {
            //console.log('clicking =' + e.target.dataset.item);
            const data = {
                id: e.target.dataset.itemId,
                name: e.target.dataset.itemName,
                status: e.target.dataset.itemStatus,
            }
            onEdit(data);
        });
        $(".delete-item").on('click', function (e) {
            onDelete(e.target.dataset.itemId);
        });
    },
    columnDefs: [],
});
//DESTRUCTURACION DE MIXIN
const {valFormularios, getAlert} = useMixin();

//METODOS
const onDelete = async (id) => {
    const resp = await categoryService.deleteOne(id);
    console.log(resp);
    await getCategory();
}

const onEdit = async (data = {}) => {
    tituloBtn.value = 'Actualizar';
    category.value = data;
    modificar.value = true;
}

const onSave = async () => {

    let resp;
    let respVal = valFormularios('formCategory');
    if (respVal) {
        if (modificar.value) {
            resp = await categoryService.updateOne(category.value.id,category.value);
        } else {
            resp = await categoryService.saveOne(category.value);
        }
        if (resp) {
            getAlert(resp.process);
            await getCategory();
            tituloBtn.value = 'Agregar';
            setEmpty();
            modificar.value = false;
        }
    } else {

    }
}

const getCategory = async () => {
    listCategories.value = await categoryService.getMany({});
}
const setEmpty = () => {
    category.value = {
        id: '',
        name: '',
        status: 0,
    };
    tituloBtn.value = 'Agregar';
    modificar.value = false;
}
onMounted(async () => {
    await getCategory();
})
</script>
<style scoped>
#category-component .al-inputs, #category-component .formSubmit {
    margin: 0;
}


</style>
