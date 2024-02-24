<template>
    <MainLayout title="Order Management" :rail="false" ref="snackBarModal">

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <v-data-table :headers="headers" :items="data.data" :sort-by="[{ key: 'name', order: 'asc' }]"
                class="elevation-2" :search="search">
                <template v-slot:top>
                    <v-toolbar flat>
                        <v-toolbar-title>{{ title }} Management</v-toolbar-title>
                        <v-divider class="mx-4" inset vertical></v-divider>
                        <v-spacer></v-spacer>
                        <v-btn prepend-icon="mdi-plus" variant="outlined" @click="openCreate" color="info">
                            Create {{ title }}
                        </v-btn>
                        <div style="width: 10px;"></div>
                        <v-btn prepend-icon="mdi-upload" variant="outlined" @click="uploadItem" color="info" v-if="upload">
                            Upload
                        </v-btn>
                        <!-- <myCreate :form_data="form_data" :title="title" :modelRoute="modelRoute" ref="createModal" /> -->


                    </v-toolbar>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line
                        hide-details></v-text-field>
                </template>
                <template v-slot:item.actions="{ item }">
                    <div class="actions">

                        <v-tooltip location="bottom">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="openEdit(item.id)" variant="text">
                                    <v-icon color="info">
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Edit</span>
                        </v-tooltip>
                        <v-tooltip location="bottom">
                            <template v-slot:activator="{ props }">
                                <v-btn icon v-bind="props" @click="deleteItem(item)">
                                    <v-icon color="red">
                                        mdi-delete
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Delete</span>
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
        <componentEdit ref="editModal" :modelRoute="modelRoute" :title="title" />
        <myUpload ref="uploadModal" :modelRoute="modelRoute" :title="title" />
        <myCreate ref="createModal" :form_data="form_data" :modelRoute="modelRoute" :title="title" />


        <v-dialog v-model="dialogDelete" max-width="400px">
            <v-card>
                <v-card-title class="text-h5">Warning!</v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    Are you sure you want to delete this item?
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn color="red-darken-1" variant="tonal" @click="close">
                        <v-icon>mdi-close-box</v-icon>Cancel
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="info" variant="tonal" @click="deleteItemConfirm">
                        <v-icon>mdi-checkbox-marked</v-icon>OK
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout.vue';
import { router } from '@inertiajs/vue3'

import myCreate from './create.vue'
import componentEdit from './edit.vue';
import myUpload from './upload.vue';
import axios from 'axios';
export default {
    props: {
        data: Object,
        form_data: Object,
        headers: Object,
        modelRoute: String,
        title: String,
        upload: Boolean
    },
    components: {
        MainLayout, myCreate, componentEdit, myUpload
    },
    data() {
        return {
            search: '',
            page: 1,
            dialogDelete: false,
            itemsPerPage: 5,
            editedIndex: -1,
            editedItem: {}
        }
    },
    methods: {
        goTo(route) {
            router.visit(route)
        },
        openEdit(data) {
            this.$refs.editModal.show(data)
            // this.$emit('CallEvent', data)
        },
        openCreate() {
            this.$refs.createModal.show()
            // this.$emit('CallEvent', data)
        },
        deleteItem(item) {

            this.editedIndex = this.data.data.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true

        },
        deleteItemConfirm() {
            axios.delete(`${this.modelRoute}/${this.editedItem.id}`).then((res) => {
                console.log("🚀 ~ axios.delete ~ res:", res)
                this.dialogDelete = true
                this.data.data.splice(this.editedIndex, 1)
                this.close()
            }).catch((error) => {
                console.log("🚀 ~ axios.delete ~ error:", error)

            })


        },
        close() {
            this.dialogDelete = false
        },

        uploadItem() {
            this.$refs.uploadModal.show()
        },
    },

    computed: {
        pageCount() {
            return Math.ceil(this.data.data.length / this.itemsPerPage)
        },

        // canEdit() {
        //     const permission = 'Edit ' + this.title;
        //     if (this.$page.props.auth && this.$page.props.auth.user) {
        //         const permissions = this.$page.props.auth.user.can;
        //         // return permissions
        //         return permissions[`${permission}`];
        //     }
        //     return false;
        // }
    },
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
