<template>
    <div class="flex w-full">

        <div @click="visible = true"
            class="h-12 relative flex justify-between mx-2 px-2 w-full items-center border border-transparent  bg-slate-50 hover:bg-slate-100 focus-within:border-slate-300 rounded-full">
            <input
                class="w-full px-3 h-10 outline-none cursor-pointer rounded-full bg-transparent placeholder:text-blue-1"
                readonly :placeholder="`Heyy ${user}, Quoi de neuf?`" />

        </div>
        <Dialog v-model:visible="visible" modal :style="{ width: '40rem' }" class="bg-blue-0"
            :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
            <!-- Modal -->
            <template #header>
                <div class="flex items-center justify-center uppercase w-full">
                    <span class="font-semibold text-lg text-blue-2">Créer une publication</span>
                </div>
            </template>
            <div class="my-2 bg-gradient-to-r from-blue-900 to-blue-800 h-px"></div>
            <div>
                <div
                    class="px-2 py-3  flex items-center   cursor-pointer border-l-4 border-l-transparent hover:bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1628157588553-5eeea00af15c?crop=entropy&cs=tinysrgb&fm=jpg&ixlib=rb-1.2.1&q=60&raw_url=true&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTZ8fHVzZXJzfGVufDB8MnwwfHw%3D&auto=format&fit=crop&w=500"
                        class="h-12 w-12 border-2 border-white rounded-full" alt="">
                    <div class="ml-4">
                        <p class="text-lg font-semibold text-slate-600 m-0 p-0">Bienvenu
                        </p>
                        <p class="text-xs text-slate-400 -mt-0.5 font-normal m-0"><i
                                class="fa-solid fa-earth-americas mr-2"></i>Public</p>
                    </div>
                </div>
            </div>
            <div>
                <form @submit.prevent="addPost()">
                    <div class="py-2 px-4 bg-white rounded-b-lg dark:bg-gray-800">
                        <textarea id="contenu" rows="1" v-autoresize v-model="contenu"
                            class="block w-full p-2 text-lg text-gray-800 bg-white border-0 overflow-hidden resize-none focus:outline-none"
                            placeholder="Quoi de neuf, Mahefa?" required></textarea>
                    </div>

                    <section v-if="showImage" class="overflow-auto p-2 w-full h-full flex flex-col max-h-[500px]">
                        <input type="file" id="fileInput" @change="handleFileUpload"  hidden />
                        <header v-if="imageUrl == null" @dragover="dragOverHandler" @drop="dropHandler"
                            class="border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                            <label for="fileInput"
                                class="mt-2 rounded-full px-3 py-2 text-2xl bg-gray-200 hover:bg-gray-300"> <i
                                    class="fa-solid fa-images"></i></label>
                            <p class="mb-2 font-semibold flex flex-col text-center  text-gray-900 justify-center">
                                <span>Ajouter des photo</span>
                                <span class="text-xs text-gray-500 font-light">ou faite glisser-déposer</span>
                            </p>
                        </header>
                        <div class="relative" @mouseover="show =true" @mouseout="show =false"> 
                            <img v-if="imageUrl != null" :src="imageUrl" :alt="fileImage" width="300" height="500" 
                            class="w-full h-full  object-cover ">
                            <label for="fileInput"  v-if="show"
                                class="absolute mt-2 rounded-md px-2 py-1 left-1 top-0 text-base bg-blue-0 text-blue-1">
                                <i class="fa-solid fa-file-image mr-2"></i>Changer le photo</label>
                        </div>
                    </section>
                    <div class="mb-2 w-full bg-gray-50 rounded-lg border border-gray-200 ">
                        <div class="flex justify-between items-center py-1 px-2 border-b">
                            <div class="flex flex-wrap items-center space-x-1 sm:pl-4">
                                <span class="text-sm text-blue-1">Ajouter à votre publication</span>
                            </div>
                            <div class="flex items-center space-x-1 sm:pr-4">
                                <button type="button"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                    <i class="fa-solid fa-paperclip  px-2"></i>

                                </button>
                                <button type="button" @click="showImageAction()"
                                    class="p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                    <i class="fa-solid fa-image  px-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit"  :disabled="contenu != '' || imageUrl !=null ? false : true"
                        :class="contenu != '' ? ' bg-blue-700 text-blue-0' : 'text-gray-500 bg-blue-0'"
                        class="flex items-center justify-center w-full px-5 py-2.5 text-sm font-medium text-center  bg-blue-0 rounded-lg focus:ring-4 focus:ring-blue-200 ">
                        Publier
                    </button>
                </form>
            </div>

        </Dialog>

    </div>


</template>

<script>
import Axios from '@/_Service/caller.service'
import Dialog from 'primevue/dialog';

export default {
    name: 'Publication',
    props:{
        getAllPub:Function,
        user:String
    },
    components: {
        Dialog
    },
    data() {
        return {
            visible: false,
            showImage: false,
            show:false,
            contenu: '',
            fileImage: null,
            imageUrl: null
        }
    },
    methods: {
        showImageAction() {
            this.showImage = !this.showImage;
        },
       async addPost() {
            console.log(this.fileImage);
            const formData = new FormData();
            formData.append('image', this.fileImage);
            formData.append('contenu', this.contenu);

            console.log(formData);
                try {
                    const res = await Axios.post('add_publication', formData)
                    console.log(res)
                    if (res.data.status) {
                        this.visible = false;
                        this.getAllPub()
                    }
                } catch (error) {
                    console.log(error)
                }
        },
      
        handleFileUpload(event) {
            let file = event.target.files[0];
            if (file.type.match("image/*")) {
                let objectURL = URL.createObjectURL(file);
                this.fileImage = file
                this.imageUrl = objectURL
            } 
        },
        dragOverHandler(event) {
            event.preventDefault();
            event.dataTransfer.dropEffect = 'copy';
        },
        dropHandler(event) {
            event.preventDefault();
            const files = event.dataTransfer.files[0];
            console.log(files)
            if (files.type.match("image/*")) {
                let objectURL = URL.createObjectURL(files);
                this.fileImage = files
                this.imageUrl = objectURL
            } 
        },
    },
    directives: {
        autoresize(el) {
            const resize = () => {
                el.style.height = 'auto';
                el.style.height = el.scrollHeight + 'px';
            };
            el.addEventListener('input', resize);
            resize();
        },
    },
}
</script>
<style>
.p-dialog-header {
    padding-bottom: 5px;
}
</style>