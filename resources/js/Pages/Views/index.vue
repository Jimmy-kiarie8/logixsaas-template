<template>
    <MainLayout :title="title" :modelRoute="modelRoute" :rail="false" ref="snackBarModal">


        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <v-data-table :headers="headers" :items="table_data.data" :sort-by="[{ key: 'name', order: 'asc' }]"
                class="elevation-2" :search="search" :loading="loading">
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>{{ title }} Management</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-tooltip location="bottom">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="refresh()">
                                    <v-icon color="info">
                                        mdi-refresh
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>View geofences</span>
                        </v-tooltip>

                        <v-btn prepend-icon="mdi-plus-circle" variant="outlined" @click="openCreate('geocoder')"
                            color="info" v-if="modelRoute !== 'geofences'">
                            Add {{ title }}
                        </v-btn>


                        <v-btn prepend-icon="mdi-plus-circle" variant="tonal" @click="goTo('geocoder')" color="info" rounded
                            v-else>
                            Add {{ title }}
                        </v-btn>
                    </v-toolbar>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                        hide-details></v-text-field>
                </template>
                <template v-slot:item.actions="{ item }">
                    <div class="actions">

                        <v-tooltip location="bottom">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="openEdit(item.id)" variant="text" color="info">
                                    <v-icon>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Edit</span>
                        </v-tooltip>
                        <v-tooltip location="bottom">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="deleteItem(item)" variant="text" color="red">
                                    <v-icon>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>View geofences</span>
                        </v-tooltip>
                        <v-tooltip location="bottom" v-if="modelRoute === 'geofences'">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="geoFence(item.id)" variant="text" color="success">
                                    <v-icon>
                                        mdi-map-marker-check
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>View geofences</span>
                        </v-tooltip>
                    </div>
                </template>

                <template v-slot:item.availability_status="{ value }">
                    <v-icon color="success" size="x-small" v-if="value">mdi-circle</v-icon>
                    <v-icon color="red" size="x-small" v-else>mdi-circle</v-icon>
                </template>
                <template v-slot:item.active="{ value }">
                    <v-icon color="success" size="x-small" v-if="value">mdi-circle</v-icon>
                    <v-icon color="red" size="x-small" v-else>mdi-circle</v-icon>
                </template>
            </v-data-table>
        </div>
        <clientEdit ref="editModal" :modelRoute="modelRoute" :title="title" />
        <myCreate ref="createModal" :title="title" :modelRoute="modelRoute" :form_data="form_data" />
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3'

import myCreate from './create.vue'
import clientEdit from './edit.vue'
import axios from 'axios';
export default {
    props: {
        data: Object,
        form_data: Object,
        headers: Object,
        modelRoute: String,
        title: String
    },
    components: {
        MainLayout, myCreate, clientEdit
    },
    data() {
        return {
            search: '',
            page: 1,
            itemsPerPage: 5,
            table_data: {},
            loading: false
        }
    },
    methods: {
        goTo(route) {
            router.visit(route)
        },
        refresh() {
            this.loading = true
            axios.get(`${this.modelRoute}?json=${true}`).then((res) => {
                this.loading = false
                this.table_data = res.data

                console.log("🚀 ~ axios.get ~ res:", res)
            }).catch((error) => {
                this.loading = false
                console.log("🚀 ~ axios.get ~ error:", error)

            })
        },
        openEdit(data) {
            console.log("🚀 ~ openEdit ~ data:", data)
            this.$refs.editModal.show(data)
            // this.$emit('CallEvent', data)
        },
        openCreate() {
            this.$refs.createModal.show()
            // this.$emit('CallEvent', data)
        },
        geoFence(route) {
            router.visit(`/geofences/${route}`)
        }
    },

    computed: {
        pageCount() {
            return Math.ceil(this.data.data.length / this.itemsPerPage)
        },
    },

    mounted() {
        this.table_data = this.data
    }
}
</script>

<style>
.v-btn--icon .v-icon {
    font-size: 18px !important;
}

.actions {
    width: 200px;
}
</style>
