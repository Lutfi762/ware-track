<template>
    <Head>
        <title>Dashboard - Warehouse Tracking</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-8">
                        <div v-if="hasAnyPermission(['dashboard.sales_chart'])" class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> SALES CHART 7 DAYS</span>
                            </div>
                            <div class="card-body">
                                <!-- Example: Chart Implementation Here -->
                                <!-- Use your preferred chart library -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div v-if="hasAnyPermission(['dashboard.sales_today'])" class="card border-0 rounded-3 shadow border-top-info mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-line"></i> SALES TODAY</span>
                            </div>
                            <div class="card-body">
                                <strong>{{ salesToday }}</strong> SALES
                                <hr>
                                <h5 class="fw-bold">Rp. {{ salesAmountToday }}</h5>
                            </div>
                        </div>

                        <div v-if="hasAnyPermission(['dashboard.profits_today'])" class="card border-0 rounded-3 shadow border-top-success">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> PROFITS TODAY</span>
                            </div>
                            <div class="card-body">
                                <h5 class="fw-bold">Rp. {{ profitsAmountToday }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div v-if="hasAnyPermission(['dashboard.best_selling_product'])" class="card border-0 rounded-3 shadow border-top-warning">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-chart-pie"></i> BEST SELLING PRODUCT</span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li v-for="product in lowStockProducts" :key="product.id">{{ product.name }} - Stock: {{ product.stock }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div v-if="hasAnyPermission(['dashboard.product_stock'])" class="card border-0 rounded-3 shadow border-top-danger">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-box-open"></i> PRODUCT STOCK</span>
                            </div>
                            <div class="card-body">
                                <!-- Populate Product Stock Details -->
                                <ul>
                                    <li v-for="stock in latestStockMovements" :key="stock.product.id">{{ stock.product.name }} - Quantity: {{ stock.quantity }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</template>

<script>
    import LayoutApp from '../../../Layouts/App.vue';
    import { Head } from '@inertiajs/inertia-vue3';

    export default {
        layout: LayoutApp,
        components: {
            Head,
        },
        props: {
            movement_date: Array,
            total_quantity: Array,
            low_stock_products: Array,
            latest_stock_movements: Array,
            salesToday: Number,
            salesAmountToday: Number,
            profitsAmountToday: Number,
        }
    }
</script>

<style>
/* Add any necessary styles here */
</style>