<template>
    <v-row justify="center">
        <v-dialog persistent v-model="dialog" width="800">
            <v-divider></v-divider>
            <v-card>
                <v-card-title class="text-h5">
                    Create A {{ title }}
                </v-card-title>
                <v-card-text>
                    <myForm :form_data="form_data" />
                </v-card-text>
                <v-card-actions>
                    <v-btn variant="outlined" color="red" @click="close">
                        <v-icon>mdi-checkbox-marked</v-icon> Close
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn variant="outlined" color="info" @click="submit" :loading="loading">
                        <v-icon>mdi-plus-circle</v-icon>
                        Submit
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>
<script>
import myForm from '@/Components/FormComponent.vue';
export default {
    props: {
        form_data: Object,
        modelRoute: String,
        title: String
    },
    components: {
        myForm,
    },
    data() {
        return {
            dialog: false,
            loading: false,
            form: {}
        }
    },
    mounted() {
        console.log(this.form_data);
    },
    methods: {
        submit() {
            this.loading = true
            console.log(this.form_data);
            this.$inertia.post(`/${this.modelRoute}`, this.form_data, {
                onError: () => {
                    this.loading = false
                },
                onSuccess: () => {
                    this.loading = false
                    // this.$refs.snackBarModal.show('Created')
                    console.log('success');
                }
            })
        },

        show() {
            this.dialog = true
        },
        close() {
            this.dialog = false
        }
    },
}
</script>
