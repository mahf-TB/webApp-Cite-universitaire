<template>
    <div class="relative">
        <!-- <haut-header-vue></haut-header-vue> -->
        <div class="sticky top-0 bg-blue-2 transition duration-[400ms] shadow py-[2px] text-blue-800  z-10 w-full">
            <div class="container flex items-center justify-between  h-[65px]">
                <div class="text-blue-0 h-full">
                    <nav class="text-[14px] h-full flex items-center"> 
                        <router-link to="/accueil" class="text-blue-0 flex items-center px-4 h-full "  :class="{ 'border-b-4 border-blue-0': $route.path === '/accueil' }">
                            Accueil
                        </router-link>
                        <router-link to="/fondation" class="text-blue-0 flex items-center px-4  h-full " :class="{ 'border-b-4 border-blue-0': $route.path === '/fondation' }">
                            Qui sommes-nous?
                        </router-link>
                        <button @click="$refs.menu1.toggle($event)" class="text-blue-0 flex items-center px-4 uppercase  h-full " :class="{ 'border-b-4 border-blue-0': $route.path === '/residences' }"> 
                            Nos Résidences 
                            <Menu ref="menu1" :popup="true" class="flex" :model="items"></Menu>
                        </button>
                        <button @click="$refs.activity.toggle($event)" class="text-blue-0 flex items-center px-4 uppercase  h-full " :class="{ 'border-b-4 border-blue-0': $route.path === '/activites' }"> 
                            Activités
                            <Menu ref="activity" :popup="true" class="flex" :model="activities"></Menu>
                        </button>

                        <router-link to="/contact" class="text-blue-0 px-4 flex items-center h-full " :class="{ 'border-b-4 border-blue-0': $route.path === '/contact' }">
                            Contacts
                        </router-link>
                    </nav>
                </div>
                <div class="flex items-center text-gray-500">
                    <span v-if="isConnect" class="material-icons-outlined text-blue-0 p-2 relative cursor-pointer">
                        <i class="fa-brands fa-facebook  mx-2" style="font-size: 1.4rem"></i>
                        <i class="fa-brands fa-instagram  mx-2" style="font-size: 1.4rem"></i>
                        <i class="fa-brands fa-x-twitter  mx-2" style="font-size: 1.4rem"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from '@/_Service/caller.service'
import Menu from 'primevue/menu';
import HautHeaderVue from '../HautHeader.vue';
export default {
    name: 'Header',
    components: {
        Menu, HautHeaderVue
    },
    data() {
        return {
            items: [
                { label: 'Toutes nos logements', command: () => this.$router.push("/residences?cas=logement") },
                { label: 'Espace commun', command: () => this.$router.push("/residences?cas=espace") },
                { label: 'Service ', command: () => this.$router.push("/residences?cas=service") },
            ],
            activities: [
                { label: 'Activités sportives', command: () => this.$router.push("/activites?cas=sport") },
                { label: 'Activités éducatives', command: () => this.$router.push("/activites?cas=education") },
                { label: 'Activités divertissement ', command: () => this.$router.push("/activites?cas=divertissement") },
            ]
        }
    },
    mounted() {

    },
    computed: {
        isConnect() {
            let user = JSON.parse(localStorage.getItem('user-info'))
            console.log(user)
            if (user) {
                return false
            }
            return true
        }
    },
    methods: {


    },
}
</script>
<style></style>