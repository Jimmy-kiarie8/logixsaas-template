

<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" :expand-on-hover="rail" :rail="rail">
            <v-list>
                <v-list-item :prepend-avatar="$page.props.auth.user.profile_photo_url" :title="$page.props.auth.user.name"
                    :subtitle="$page.props.auth.user.email"></v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-list nav color="info" v-for="(link, index) in links" :key="index" id="main-layout">
                <Link :href="link.link" v-if="!link.hasSub">
                <v-list-item :prepend-icon="link.icon" class="v-link" :value="link" :class="{'isActive':  isActive(link.link)}">
                    {{ link.text }}
                </v-list-item>
                </Link>

                <v-list-group :value="link.text" v-else>
                    <template v-slot:activator="{ props }">
                        <v-list-item v-bind="props" :prepend-icon="link.icon" :title="link.text"></v-list-item>
                    </template>
                    <Link :key="i" v-for="(item, i) in link.subMenu" :href="item.link">
                    <v-list-item :title="item.text" :prepend-icon="item.icon" :value="i"></v-list-item>
                    </Link>
                </v-list-group>
            </v-list>


        </v-navigation-drawer>

        <v-app-bar id="tool-bar">
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-app-bar-title>
                Logixsaas Delivery App
            </v-app-bar-title>

            <v-btn class="ma-2" variant="text" :icon="this.$vuetify.theme.global.current.dark ? 'mdi-white-balance-sunny' : 'mdi-weather-night'" :color="this.$vuetify.theme.global.current.dark ? 'white' : 'black'" @click="changeTheme"></v-btn>

        </v-app-bar>

        <v-main>
            <slot />
        </v-main>

        <v-snackbar v-model="snackbar">
            {{ text }}

            <template v-slot:actions>
                <v-btn color="pink" variant="text" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>


    </v-app>
</template>

<script>

import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    components: {
        Link
    },
    props: {
        title: String,
        modelRoute: String,
        rail: Boolean
    },

    data() {
        return {
            drawer: true,
            snackbar: false,
            text: '',
            links: []
        }
    },

    methods: {
        show(data) {
            snackbar.value = true;
            text.value = data;
        },
        changeTheme(data) {
            console.log("🚀 ~ changeTheme ~ data:", data)
            this.$vuetify.theme.global.name = this.$vuetify.theme.global.current.dark ? 'light' : 'dark'
        },

        async loadJsonData() {
        try {
            const response = await axios.get('/data/menu.json');
            console.log("🚀 ~ loadJsonData ~ response:", response)
            this.links = response.data;
        } catch (error) {
            console.error('Error loading JSON data:', error);
        }
        }
    },
    computed: {
        isActive() {

            // return this.modelRoute == data.modelRoute

            return (route) => {
                return "/" + this.modelRoute == route
            }
        }
    },
  mounted() {
    this.loadJsonData();
  },
};
</script>

<style>
.v-theme--dark #main-layout a,
.v-theme--dark #main-layout .v-list-item--nav .v-list-item-title {
    text-decoration: none;
    cursor: pointer;
    color: #fff;

}

.v-theme--light #main-layout a,
.v-theme--light #main-layout .v-list-item--nav .v-list-item-title {
    text-decoration: none;
    cursor: pointer;
    color: #333;

}

/*
.v-navigation-drawer__content, #tool-bar .v-toolbar__content, #tool-bar .v-toolbar__extension{
    background: #049569 ;
}*/

.v-card {
    padding: 15px !important;
    border-radius: 15px 0 15px 15px !important;
}

.v-btn {
    height: calc(var(--v-btn-height) + 0px);
    text-transform: none;
}

.isActive {
    background: #7b90dd40 !important;
}
</style>
