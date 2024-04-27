<template>
    <v-row justify="center">
        <v-dialog persistent v-model="dialog" width="800">
            <v-divider></v-divider>
            <v-card>
                <v-card-title class="text-h5">
                    Upload Image
                </v-card-title>
                <v-card-text>
                    <form enctype="multipart/form-data" @submit="submitForm">
                        <input type="file" @change="onChange">
                    </form>
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="outlined" color="error" @click="close">
                        Close
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="info" prepend-icon="mdi-plus-box" @click="submitForm"
                        :loading="loading">
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-snackbar v-model="snackbar">
            {{ text }}
        </v-snackbar>
    </v-row>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        product_editing: Number,
        modelRoute: String,
    },
    components: {
    },
    data() {
        return {
            dialog: false,
            loading: false,
            snackbar: false,
            text: 'Product Created',
            form: {},
            file: {}
        }
    },
    mounted() {
    },
    methods: {
        onChange(e) {
            console.log("🚀 ~ file: image-upload.vue:50 ~ onChange ~ e:", e)
            this.file.value = e.target.files[0]
        },
        submitForm(e) {
            this.loading = true
            e.preventDefault();
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            let data = new FormData();
            data.append('file', this.file.value)
            console.log("🚀 ~ submitForm ~ this.file.value:", this.file.value)

            axios.post(`${this.modelRoute}-image/${this.form.id}`, data, config).then((res) => {
                this.loading = false
                this.snackbar = true
                this.text = 'Image created'
                console.log("🚀 ~ file: image-upload.vue:76 ~ axios.post ~ res:", res)
            }).catch((error) => {
                this.loading = false
                this.snackbar = true
                this.text = 'Something went wrong'
                console.log("🚀 ~ file: image-upload.vue:78 ~ axios.post ~ error:", error)

            })
        },
        close() {
            this.dialog = false
        },
        show(data) {
            this.form = data;
            this.dialog = true
        }
    },
}
</script>
