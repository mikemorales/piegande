<script setup>
import {onMounted, ref} from 'vue';

import {productService} from './Services/Product.service';
import {categoryService} from "./Services/Category.service";

const infoProd = ref({});
const listProducts = ref([]);
const listCategories = ref([]);

const getProducts = async () => {
    listProducts.value = await productService.getMany();
    listCategories.value = await categoryService.getMany();
}

const getByCategory = async () => {
    //console.log(category_id.value);
    listProducts.value = await productService.getByCategory(category_id.value);
}

const showProduct = (product) => {
    infoProd.value = product;
}

const category_id = ref(0);

onMounted(async () => {
    await getProducts();
});

</script>
<template>
    <div id="frontForm" class="flex-align-vertical frontForm">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">{{ infoProd.name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p v-if="infoProd.relmodelshoe">
                            MODELO: {{ infoProd.relmodelshoe.name }}
                        </p>
                        <p>
                            SKU: {{ infoProd.sku }}
                        </p>
                        <p v-if="infoProd.relbrandshoe">
                            MARCA: {{ infoProd.relbrandshoe.name }}
                        </p>
                        <p v-if="infoProd.relcategoryshoe">
                            CATEGORÍA : {{ infoProd.relcategoryshoe.name }}
                        </p>
                        <p>
                            TAMAÑOS : {{ infoProd.size }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- EndModal -->
        <div class="container">

            <div class="row">
                <div class="col-12 col-sm-12">
                    <select data-select="on" v-model="category_id" v-on:change="getByCategory" data-name-input="Categoria del Calzado" name="category_id" class="form-select required mb-3" id="input-9">
                        <option :value="0">Seleccione una categoria</option>
                        <option v-for="cat in listCategories" :value="cat.id" :key="cat.id">{{ cat.name }}</option>
                    </select>
                </div>
            </div>
            <ul class="row">
                <li class="col-12 col-sm-4" v-for="prod in listProducts" :key="prod.id">
                    <div class="card" style="width: 18rem;">
                        <img :src="'/storage/product/'+prod.picture" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">{{ prod.name }}</h5>
                            <p class="card-text">${{ prod.price }} precio</p>
                            <p class="card-text">Cantidad: {{ prod.quantity }}</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" v-on:click="showProduct(prod)">
                                Ver Productos
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<style scoped>

</style>
