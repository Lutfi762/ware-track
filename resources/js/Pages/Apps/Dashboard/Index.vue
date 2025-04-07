<template>
    <Head>
        <title>Dashboard - Aplikasi Kasir</title>
    </Head>

    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">

                <div class="row">
                    <div class="col-md-8">
                        <!-- Stock Movements for the Last 7 Days -->
                        <div v-if="hasAnyPermission(['dashboard.stock_movements'])" class="card border-0 rounded-3 shadow border-top-purple">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-history"></i> STOCK MOVEMENTS LAST 7 DAYS</span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li v-for="(date, index) in movement_date" :key="index">
                                        {{ date }}: {{ total_quantity[index] }} (In: {{ total_in[index] }}, Out: {{ total_out[index] }})
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <!-- Low Stock Products -->
                        <div v-if="hasAnyPermission(['dashboard.low_stock_products'])" class="card border-0 rounded-3 shadow border-top-danger mb-4">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-exclamation-triangle"></i> LOW STOCK PRODUCTS</span>
                            </div>
                            <div class="card-body">
                                <ul v-if="low_stock_products.length">
                                    <li v-for="(product, index) in low_stock_products" :key="index">
                                        {{ product.name }}: {{ product.quantity }} left
                                    </li>
                                </ul>
                                <p v-else class="text-muted">No low stock products available.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <!-- Latest Stock Movements -->
                        <div v-if="hasAnyPermission(['dashboard.latest_stock_movements'])" class="card border-0 rounded-3 shadow border-top-warning">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-history"></i> LATEST STOCK MOVEMENTS</span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li v-for="(movement, index) in latest_stock_movements" :key="index">
                                        {{ movement.product.name }}: {{ movement.quantity }} ({{ movement.movement_type }}) on {{ movement.created_at }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Activity Log -->
                        <div v-if="hasAnyPermission(['dashboard.activity_log'])" class="card border-0 rounded-3 shadow border-top-info">
                            <div class="card-header">
                                <span class="font-weight-bold"><i class="fa fa-tasks"></i> ACTIVITY LOG</span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li v-for="(activity, index) in activity_log" :key="index">
                                        {{ activity.product.name }}: {{ activity.quantity }} ({{ activity.movement_type }}) on {{ activity.created_at }}
                                    </li>
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
    // Import layout
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
            total_in: Array,
            total_out: Array,
            low_stock_products: Array,
            latest_stock_movements: Array,
            activity_log: Array,
        },
    }
</script>

<style>
/* Tambahkan gaya CSS jika diperlukan */
.text-muted {
    color: #6c757d; /* Warna untuk teks yang tidak aktif */
}
</style>