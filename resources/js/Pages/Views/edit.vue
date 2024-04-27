<template>
    <v-row justify="center">
        <v-dialog persistent v-model="dialog" width="800">

            <v-divider></v-divider>
            <v-card :loading="loading">
                <v-card-title class="text-h5">
                    Edit {{ title }}
                </v-card-title>
                <v-card-text>
                    <myForm :form_data="form_data" />
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="outlined" color="error" @click="close">
                        Close
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="primary" @click="submit" :loading="loading">
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-card>

            <v-snackbar v-model="snackbar">
                {{ text }}

                <template v-slot:actions>
                    <v-btn color="pink" variant="text" @click="snackbar = false">
                        Close
                    </v-btn>
                </template>
            </v-snackbar>
        </v-dialog>
    </v-row>
</template>
<script>
import myForm from '@/Components/FormComponent.vue';
import axios from 'axios';
export default {
    props: {
        modelRoute: String,
        title: String,
    },
    components: {
        myForm,
    },
    data() {
        return {
            loading: false,
            dialog: false,
            form_data: {},
            snackbar: false,
            text: 'Created',
            id: null
        }
    },
    mounted() {
    },
    methods: {
        submit() {
            this.loading = true
            console.log(this.form_data);
            this.$inertia.patch(`/${this.modelRoute}/${this.id}`, this.form_data, {
                onError: () => {
                    this.loading = false
                    this.text = 'Something went wrong';
                    this.snackbar = true
                },
                onSuccess: () => {
                    this.text = 'Updated';

                    this.loading = false
                    this.snackbar = true
                    // this.$refs.snackBarModal.show('Created')
                    console.log('success');
                }
            })

            setTimeout(() => {
                this.loading = false
            }, 5000);
        },
        close() {
            this.dialog = false
        },

        show(data) {
            this.id = data
            this.loading = true
            this.dialog = true
            axios.get(`${this.modelRoute}/${data}/edit`).then((res) => {
                this.loading = false

                console.log("🚀 ~ axios.get ~ res:", res)
                this.form_data = res.data;
            }).catch((error) => {
                console.log("🚀 ~ axios.get ~ error:", error)
                this.loading = false

            })
        },
        hide() {
            this.dialog = false
        },
    },
}
</script>
