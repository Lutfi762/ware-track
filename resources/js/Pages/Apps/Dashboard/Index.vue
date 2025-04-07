<template>
    <Head>
        <title>Dashboard - Warehouse Tracking</title>
    </Head>

    <main class="c-main">
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-md-8">
                    <!-- Sales Chart for the Last 7 Days -->
                    <div v-if="hasAnyPermission(['dashboard.stock_movements'])" class="card border-0 rounded-3 shadow border-top-purple mb-4">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-chart-bar"></i> STOCK MOVEMENTS CHART LAST 7 DAYS</span>
                        </div>
                        <div class="card-body">
                            <!-- Chart component or code will go here -->
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Stock Movements for the Last 7 Days -->
                    <div v-if="hasAnyPermission(['dashboard.stock_movements'])" class="card border-0 rounded-3 shadow border-top-purple mb-4">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-history"></i> STOCK MOVEMENTS TODAY</span>
                        </div>
                        <div class="card-body">
                            <div class="cart">
                                <div class="cart-header">
                                    <div class="cart-item">
                                        <span>Date</span>
                                        <span>Total Quantity</span>
                                        <span>In</span>
                                        <span>Out</span>
                                    </div>
                                </div>
                                <div class="cart-body">
                                    <div class="cart-item" v-for="(date, index) in movement_date" :key="index">
                                        <span>{{ date }}</span>
                                        <span>{{ total_quantity[index] }}</span>
                                        <span>{{ total_in[index] }}</span>
                                        <span>{{ total_out[index] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Stock Movements for Today -->
                    <div v-if="hasAnyPermission(['dashboard.stock_movements_today'])" class="card border-0 rounded-3 shadow border-top-purple mb-4">
                        <div class="card-header">
                            <span class="font-weight-bold"><i class="fa fa-history"></i> STOCK MOVEMENTS TODAY</span>
                        </div>
                        <div class="card-body">
                            <div class="cart">
                                <div class="cart-header">
                                    <div class="cart-item">
                                        <span>Product</span>
                                        <span>Quantity</span>
                                        <span>Movement Type</span>
                                        <span>Date</span>
                                    </div>
                                </div>
                                <div class="cart-body">
                                    <div class="cart-item" v-for="(movement, index) in today_stock_movements" :key="index">
                                        <span>{{ movement.product.name }}</span>
                                        <span>{{ movement.quantity }}</span>
                                        <span>{{ movement.movement_type }}</span>
                                        <span>{{ movement.created_at }}</span>
                                    </div>
                                </div>
                            </div>
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