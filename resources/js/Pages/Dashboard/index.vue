<template>
    <MainLayout title="Dashboard">
        <v-row no-gutters>
            <template v-for="(item, index) in data" :key="index">
                <v-col cols="12" sm="3" style="padding: 3px;" v-if="index < 4">
                    <v-card class="mx-auto">
                        <v-card-item :title="item.label">
                            <template v-slot:subtitle>
                                <v-icon :icon="item.icon" size="18" :color="item.iconColor" class="me-1 pb-1"></v-icon>
                                {{ item.label }}
                            </template>
                        </v-card-item>

                        <v-card-text class="py-0">
                            <v-row align="center" no-gutters>
                                <v-col class="value-text" cols="6">
                                    {{ item.value }}
                                </v-col>

                                <v-col cols="6" class="text-right">
                                    <v-icon :color="item.iconColor" :icon="item.icon" size="88"></v-icon>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <div class="d-flex py-3 justify-space-between">
                            <v-list-item density="compact" prepend-icon="mdi-store-24-hour">
                                <v-list-item-subtitle>Percentage</v-list-item-subtitle>
                            </v-list-item>

                            <v-list-item density="compact" prepend-icon="mdi-percent-circle">
                                <v-list-item-subtitle>{{ ((item.value / total) * 100).toFixed(2) }}%</v-list-item-subtitle>
                            </v-list-item>
                        </div>
                        <v-divider></v-divider>


                        <v-card-actions>
                        </v-card-actions>
                    </v-card>
                </v-col>

            </template>
            <v-col cols="12" sm="6" style="padding: 3px;">
                <v-card class="mx-auto">
                    <lineChart :chartData="monthlySalesData" />
                </v-card>
            </v-col>
            <v-col cols="12" sm="6" style="padding: 3px;">
                <v-card class="mx-auto">
                    <doughnutChart :chartData="deliveriesByStatusData" />
                </v-card>
            </v-col>

        </v-row>


        <v-row no-gutters>
            <template v-for="(item, index) in data" :key="index">
                <v-col cols="12" sm="3" style="padding: 3px;" v-if="index > 4 && index < 9">
                    <v-card class="mx-auto">
                        <v-card-item :title="item.label">
                            <template v-slot:subtitle>
                                <v-icon :icon="item.icon" size="18" :color="item.iconColor" class="me-1 pb-1"></v-icon>
                                {{ item.label }}
                            </template>
                        </v-card-item>
                        <v-card-text class="py-0">
                            <v-row align="center" no-gutters>
                                <v-col class="value-text" cols="6">
                                    {{ item.value }}
                                </v-col>

                                <v-col cols="6" class="text-right">
                                    <v-icon :color="item.iconColor" :icon="item.icon" size="88"></v-icon>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <div class="d-flex py-3 justify-space-between">
                            <v-list-item density="compact" prepend-icon="mdi-store-24-hour">
                                <v-list-item-subtitle>Percentage</v-list-item-subtitle>
                            </v-list-item>

                            <v-list-item density="compact" prepend-icon="mdi-percent-circle">
                                <v-list-item-subtitle>{{ ((item.value / total) * 100).toFixed(2) }}%</v-list-item-subtitle>
                            </v-list-item>
                        </div>
                        <v-divider></v-divider>

                        <v-card-actions>
                        </v-card-actions>
                    </v-card>
                </v-col>

            </template>

            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-card class="mx-auto">
                    <lineChart :chartData="revenueOverTimeData" />
                </v-card>
            </v-col>
            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-card class="mx-auto">
                    <barChart :chartData="driverPerformanceData" />
                </v-card>
            </v-col>
            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-card class="mx-auto">
                    <lineChart :chartData="profitMarginOverTimeData" />
                </v-card>
            </v-col>
        </v-row>



        <v-row no-gutters>
            <template v-for="(item, index) in data" :key="index">
                <v-col cols="12" sm="6" style="padding: 3px;" v-if="index > 9">
                    <v-card class="mx-auto">
                        <v-card-item :title="item.label">
                            <template v-slot:subtitle>
                                <v-icon :icon="item.icon" size="18" :color="item.iconColor" class="me-1 pb-1"></v-icon>
                                {{ item.label }}
                            </template>
                        </v-card-item>

                        <v-card-text class="py-0">
                            <v-row align="center" no-gutters>
                                <v-col class="value-text" cols="6">
                                    {{ item.value }}
                                </v-col>

                                <v-col cols="6" class="text-right">
                                    <v-icon :color="item.iconColor" :icon="item.icon" size="88"></v-icon>
                                </v-col>
                            </v-row>
                        </v-card-text>

                        <div class="d-flex py-3 justify-space-between">
                            <v-list-item density="compact" prepend-icon="mdi-store-24-hour">
                                <v-list-item-subtitle>Percentage</v-list-item-subtitle>
                            </v-list-item>

                            <v-list-item density="compact" prepend-icon="mdi-percent-circle">

                                <v-list-item-subtitle>{{ ((item.value / total) * 100).toFixed(2) }}%</v-list-item-subtitle>
                            </v-list-item>
                        </div>
                        <v-divider></v-divider>

                        <v-card-actions>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </template>
        </v-row>

        <v-row no-gutters>
            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-list color="info">
                    <v-list-subheader inset>Sales By Delivery Status</v-list-subheader>
                    <v-list-item v-for="(sale, index) in salesByDeliveryStatus" :key="index" :title="sale.delivery_status" :value="index">
                        <template v-slot:prepend>
                            <v-avatar>
                                <v-icon color="white">mdi-information</v-icon>
                            </v-avatar>
                        </template>

                        <template v-slot:append>
                            <v-chip>{{ sale.count }}</v-chip>
                        </template>
                    </v-list-item>
                </v-list>
            </v-col>
            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-list color="info">
                    <v-list-subheader inset>Delivery Status Counts</v-list-subheader>
                    <v-list-item v-for="(item, index) in deliveryStatusCounts" :key="index" :title="index" :value="index">
                        <template v-slot:prepend>
                            <v-avatar>
                                <v-icon color="white">mdi-clock</v-icon>
                            </v-avatar>
                        </template>

                        <template v-slot:append>
                            <v-chip>{{ item }}</v-chip>
                        </template>
                    </v-list-item>
                </v-list>
            </v-col>
            <v-col cols="12" sm="4" style="padding: 3px;">
                <v-list color="info">
                    <v-list-subheader inset>Sales Over Time</v-list-subheader>
                    <v-list-item v-for="(sale, index) in salesOverTime" :key="index" :title="sale.date" :value="index">
                        <template v-slot:prepend>
                            <v-avatar>
                                <v-icon color="white">mdi-cart</v-icon>
                            </v-avatar>
                        </template>

                        <template v-slot:append>
                            <v-chip>{{ sale.count }}</v-chip>
                        </template>
                    </v-list-item>
                </v-list>
            </v-col>
        </v-row>
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import barChart from './bar-chart.vue'
import lineChart from './line-chart.vue'
import doughnutChart from './doughnut-chart.vue'
export default {
    props: {
        total: Number,
        data: Object,

        deliveriesByStatusData: Object,
        revenueOverTimeData: Object,
        monthlySalesData: Object,
        profitMarginOverTimeData: Object,
        driverPerformanceData: Object,

        salesByDeliveryStatus: Object,
        deliveryStatusCounts: Object,
        salesOverTime: Object,
    },

    components: {
        MainLayout, doughnutChart, lineChart, barChart
    },
    data() {
        return {
            search: '',
            page: 1,
            itemsPerPage: 5
        }
    },
    methods: {
    },
}
</script>
<style scoped>
.v-col-sm-3 {
    padding: 10px;

}

.value-text {
    font-size: 45px !important;
}
</style>
