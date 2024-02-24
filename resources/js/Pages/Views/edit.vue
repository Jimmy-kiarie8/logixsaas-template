<template>
    <v-row justify="center">
        <v-dialog persistent v-model="dialog" width="800">

            <v-divider></v-divider>
            <v-card>
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
                    <v-btn variant="outlined" color="primary" @click="submit">
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-card>
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
            dialog: false,
            form_data: {},
            id: null
        }
    },
    mounted() {
    },
    methods: {
        submit() {
            console.log(this.form_data);
            this.$inertia.patch(`/${this.modelRoute}/${this.id}`, this.form_data, {
                onError: () => { },
                onSuccess: () => {
                    console.log('success');
                    // this.$refs.snackBarModal.show('Updated')
                }
            })
        },
        close() {
            this.dialog = false
        },

        show(data) {
            this.id = data
            this.dialog = true
            axios.get(`${this.modelRoute}/${data}/edit`).then((res) => {

                console.log("🚀 ~ axios.get ~ res:", res)
                this.form_data = res.data;
            }).catch((error) => {
                console.log("🚀 ~ axios.get ~ error:", error)

            })
        },
        hide() {
            this.dialog = false
        },
    },
}
</script>
