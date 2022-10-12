<template>
    <div id="product-component">
        <div class="container">
            <div id="barraSec" class="row padFixBoth">

                <div class="col-12 col-sm-12 nopadding">
                    <h1 class="secTitle">PRODUCTOS</h1>
                </div>

            </div>
            <main id="mainContent" class="padFixBoth">

                <form id="formProducts" class="row justify-content-center formProducts">

                    <div class="col-12 col-sm-6">
                        <p>
                            <input type="text" class="al-inputs required" name="name" v-model="product.name" placeholder="Nombre del Producto" id="">
                        </p>
                        <p>
                            <input type="text" class="al-inputs required" name="quantity" v-model="product.quantity" placeholder="Cantidad" id="">
                        </p>
                        <p>
                            <input type="text" class="al-inputs required" name="price" v-model="product.price" placeholder="Precio" id="">
                        </p>
                        <p>
                            <input type="text" class="al-inputs required" name="sku" v-model="product.sku" placeholder="Sku" id="">
                        </p>
                        <p>
                            <button type="button" class="formSubmit" v-on:click="onSave()">{{ tituloBtn }}</button>
                        </p>

                    </div>
                    <div class="col-12 col-sm-6">
                        <p>
                            <select data-select="on" class="required" data-name-input="Status Evento" name="status" v-model="product.status" id="status_agente">
                                <option :value="0">Status del Producto</option>
                                <option :value="1">Inactivo</option>
                                <option :value="2">Activo</option>
                            </select>
                        </p>
                        <p>
                            <select data-select="on" data-name-input="Categoria del Calzado" name="category_id" class="form-select required mb-3" v-model="product.category_id" id="input-9">
                                <option :value="0">Seleccione una categoria</option>
                                <option v-for="cat in listCategories" :value="cat.id" :key="cat.id">{{ cat.name }}</option>
                            </select>
                        </p>
                        <p>
                            <select data-select="on" data-name-input="Marca del Calzado" name="brand_id" class="form-select required mb-3" v-model="product.brand_id" id="input-9">
                                <option :value="0">Seleccione una marca</option>
                                <option v-for="brand in listBrands" :value="brand.id" :key="brand.id">{{ brand.name }}</option>
                            </select>
                        </p>
                        <p>
                            <select data-select="on" data-name-input="Modelo del Calzado" name="model_id" class="form-select required mb-3" v-model="product.model_id" id="input-9">
                                <option :value="0">Seleccione un modelo</option>
                                <option v-for="modelShoe in listModels" :value="modelShoe.id" :key="modelShoe.id" :data-sku="modelShoe.code">{{ modelShoe.name }}</option>
                            </select>
                        </p>
                        <h6>Tamaños disponibles</h6>
                        <ul>
                            <li class="float" style="margin-left:10px;" v-for="(sze,index) in listSize" :key="sze.id">
                                <input type="checkbox" name="size[]" :value="sze.size" v-model="product.size">
                                <label style="margin-left:5px;">{{ sze.size }}</label>
                            </li>
                        </ul>
                        <div class="fotoUploader">
                            <span class="btn btn-file">
                                Imagen <br> <i class="fas fa-upload"></i> <input type="file" data-label="avatar" name="picture" v-on:change="getLogo" placeholder="avatar">
                            </span>
                            <span class="label-file-papeleria alert alert-info logo"></span>
                        </div>

                    </div>
                </form>

            </main>
        </div>
        <div id="mainContent" class="container-fluid">

            <div class="view">
                <DataTable id="guest_table" :columns="columns" :data="listProducts" :options="dataTableOptions" ref="table" class="table table-hover table-striped view" width="100%">
                    <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sku</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tamaños</th>
                        <th>Acciones</th>

                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Sku</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tamaños</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </DataTable>
            </div>

        </div>

    </div>
</template>
<script setup>
import {onMounted, ref} from 'vue';
import {useMixin} from '../mixins/useMixin';
import {productService} from "../Services/Product.service";
import {categoryService} from "../Services/Category.service";
import {brandService} from "../Services/Brand.service";
import {modelShoeService} from "../Services/ModelShoe.service";
import {sizeService} from "../Services/Size.service";
import {getFormData} from "../Utils/getDataForm";
import Buttons from 'datatables.net-buttons';
import jszip from 'jszip';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import DataTable from 'datatables.net-vue3';
import DataTableBs5 from 'datatables.net-bs5';
import $ from "jquery";

DataTable.use(DataTableBs5);
DataTable.use(Buttons);
DataTable.use(ButtonsHtml5);
DataTable.use(jszip);

//ESTADOS
const product = ref({
    id: '',
    name: '',
    model_id: 0,
    sku: '',
    brand_id: 0,
    picture: '',
    quantity: '',
    category_id: 0,
    price: '',
    size: [],
    status: 0,
});
const tituloBtn = ref('Agregar');
const listProducts = ref([]);
const listBrands = ref([]);
const listModels = ref([]);
const listCategories = ref([]);
const listSize = ref([]);
const modificar = ref(false);
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
const columns = ref([
    {data: 'name'},
    {data: 'quantity'},
    {data: 'price'},
    {data: 'sku'},
    {
        data: 'status',
        render: function (data, type, row) {
            if (data === 1) {
                return '<span class="badge rounded-pill text-bg-success">Activa</span>';
            } else if (data === 2) {
                return '<span class="badge rounded-pill text-bg-warning">Inactiva</span>';
            }
        }
    },
    {data: 'relcategoryshoe.name'},
    {data: 'relbrandshoe.name'},
    {data: 'relmodelshoe.name'},
    {
        data: 'size',
    },
    {
        data: 'action',
        wrap: true,
        render: function (data, type, row) {
            let buttons = '<button data-item-id="' + row.id + '" data-item-name="' + row.name + '" data-item-code="' + row.code + '" data-item-status="' + row.status + '" class="edit btn btn-warning btn-xs btn-flat edit-item">Edit</button>'
            buttons += '<button class="delete btn btn-danger btn-xs btn-flat delete-item" data-item-id="' + row.id + '">Delete</button>'
            return buttons;
        },

    },

]);

//DESTRUCTURACION DE MIXIN
const {valFormularios, getAlert, getNameFile} = useMixin();

//METODOS
const onDelete = async (id) => {
    const resp = await productService.deleteOne(id);
    getAlert(resp.process);
    await getProducts();
}

const onEdit = async (data = {}) => {
    tituloBtn.value = 'Actualizar';
    product.value = data;
    modificar.value = true;
}

const onSave = async () => {
    let resp;
    let respVal = valFormularios('formProducts');
    const formData = getFormData('formProducts');
    if (respVal) {
        if (modificar.value) {
            resp = await productService.updateOne(product.value.id, formData, {isFrom: true});
        } else {
            resp = await productService.saveOne(formData, {isForm: true});
        }
        if (resp) {
            getAlert(resp.process);
            tituloBtn.value = 'Agregar';
            setEmpty();
            modificar.value = false;
            await getProducts();
        }
    } else {
    }
}

const getProducts = async () => {
    listModels.value = await modelShoeService.getMany();
    listCategories.value = await categoryService.getMany();
    listBrands.value = await brandService.getMany();
    listProducts.value = await productService.getMany();
    listSize.value = await sizeService.getMany();
}

const getLogo = (event) => {
    getNameFile(event, 'logo');
}

const setEmpty = () => {

    product.value = {
        id: '',
        name: '',
        model: 0,
        model_sku: '',
        brand: 0,
        picture: '',
        quantity: 0,
        category_id: 0,
        price: 0,
        status: 0,
    };

    tituloBtn.value = 'Agregar';
    modificar.value = false;
}
onMounted(async () => {
    await getProducts();
})
</script>
<style scoped>
#product-component .al-inputs, #product-component .formSubmit {
    margin: 10px;
}


</style>
