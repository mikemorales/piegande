<template>
    <div id="model-component">

        <div class="container">
            <div id="barraSec" class="row padFixBoth">

                <div class="col-12 col-sm-12 nopadding">
                    <h1 class="secTitle">MODELO</h1>
                </div>

            </div>
            <main id="mainContent" class="padFixBoth">

                <form id="" class="animated fadeIn margin-al-inputs formBrand">
                    <div class="row">

                        <div class="col-3">
                            <input type="text" class="al-inputs required" v-model="model_shoe.name" placeholder="Nombre del Modelo" id="">
                        </div>
                        <div class="col-3">
                            <input type="text" class="al-inputs required" v-model="model_shoe.code" placeholder="Código del Modelo" id="">
                        </div>

                        <div class="col-3">
                            <select data-select="on" class="required" data-name-input="Status Modelo" name="status" v-model="model_shoe.status" id="status_agente">
                                <option :value="0">Status del modelo</option>
                                <option :value="1">Inactiva</option>
                                <option :value="2">Activa</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <button type="button" class="formSubmit" v-on:click="onSave()">{{ tituloBtn }}</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <DataTable id="guest_table" :columns="columns" :data="listModelShoe" :options="dataTableOptions" ref="table" class="table table-hover table-striped view" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Acciones</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
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
import {onMounted, ref} from 'vue';
import {modelShoeService} from '../Services/ModelShoe.service';
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
const listModelShoe = ref([]);
const modificar = ref(false);
const model_shoe = ref({
    id: '',
    name: '',
    code: '',
    status: 0,
});
const columns = ref([
    {data: 'name'},
    {data: 'code'},
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
        data: 'action',
        wrap: true,
        render: function (data, type, row) {
            let buttons = '<button data-item-id="' + row.id + '" data-item-name="' + row.name + '" data-item-code="' + row.code + '" data-item-status="' + row.status + '" class="edit btn btn-warning btn-xs btn-flat edit-item">Edit</button>'
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
                code: e.target.dataset.itemCode,
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
    const resp = await modelShoeService.deleteOne(id);
    console.log(resp);
    await getModelShoe();
}

const onEdit = async (data = {}) => {
    tituloBtn.value = 'Actualizar';
    model_shoe.value = data;
    modificar.value = true;
}

const onSave = async () => {
    let resp;
    let respVal = valFormularios('formBrand');
    if (respVal) {
        if (modificar.value) {
            resp = await modelShoeService.updateOne(model_shoe.value.id, model_shoe.value);
        } else {
            resp = await modelShoeService.saveOne(model_shoe.value);
        }
        if (resp) {
            getAlert(resp.process);
            await getModelShoe();
            tituloBtn.value = 'Agregar';
            setEmpty();
            modificar.value = false;
        }
    } else {
    }
}

const getModelShoe = async () => {
    listModelShoe.value = await modelShoeService.getMany();
}
const setEmpty = () => {
    model_shoe.value = {
        id: '',
        name: '',
        code: '',
        status: 0,
    };
    tituloBtn.value = 'Agregar';
    modificar.value = false;
}
onMounted(async () => {
    await getModelShoe();
})
</script>
<style scoped>
#model-component .al-inputs, #model-component .formSubmit {
    margin: 0;
}
</style>
