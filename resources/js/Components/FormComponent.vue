<!-- <script setup>
import { VDatePicker } from 'vuetify/labs/VDatePicker'
import { ref } from 'vue';

defineProps({
    form_data: Object,
});

const dialog = ref(false);

</script> -->
<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
    form_data: Object,
});

const emit = defineEmits(['update:plots']);

const onProjectChange = (item) => {
    if (item.model == "project_id") {
        fetchPlotsForProject(item.value);
    }
};


// Function to fetch plots
const fetchPlotsForProject = async (projectId) => {
    try {
        const response = await axios.get(`/plots/${projectId}`);
        // Assuming the response contains an array of plots
        const plots = response.data;

        // Find the plot item in the form_data
        const plotItem = props.form_data.find(item => item.model === 'plot_id');

        // If the plot item exists, update its items array
        if (plotItem) {
            plotItem.items = plots;
        }

    } catch (error) {
        console.error('Failed to fetch plots:', error);
    }
};
</script>


<template>
    <v-row>
        <template v-for="item in form_data">
            <v-col :cols="item.col" :md="item.col" v-if="item.display">
                <div>
                    <v-text-field clearable :label="item.label" variant="outlined" v-model="item.value"
                        v-if="item.type == 'text'" type="text"></v-text-field>
                    <v-text-field clearable :label="item.label" variant="outlined" v-model="item.value"
                        v-if="item.type == 'number'" type="number"></v-text-field>
                    <v-text-field clearable :label="item.label" variant="outlined" v-model="item.value"
                        v-if="item.type == 'date'" type="date"></v-text-field>
                    <v-text-field clearable :label="item.label" variant="outlined" v-model="item.value"
                        v-if="item.type == 'time'" type="time"></v-text-field>

                    <v-textarea clearable :label="item.label" variant="outlined" v-model="item.value"
                        v-if="item.type == 'long_text'"></v-textarea>
                    <v-radio-group v-model="item.value" inline v-if="item.type == 'radio'" color="success">
                        <template v-slot:label>
                            <div>{{ item.label }}</div>
                        </template>
                        <v-radio v-for="(option, index) in item.items" :key="index" :label="option"
                            :value="option"></v-radio>
                    </v-radio-group>

                    <v-select clearable chips :label="item.label" :items="item.items" variant="outlined"
                        v-if="item.type == 'select'" item-title="label" item-value="value" v-model="item.value"
                        @update:modelValue="onProjectChange(item)" :multiple="item.multiple"
                        :return-object="false"></v-select>
                </div>
            </v-col>
        </template>
    </v-row>
</template>

