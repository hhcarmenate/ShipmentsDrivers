<template>
    <div class="relative w-64 mt-4 mb-4 p-4">
        <label class="bg-gray-600 cursor-pointer hover:bg-gray-800 text-white font-bold py-2 px-4 w-full inline-flex items-center rounded-md focus:outline-none">
            <svg fill="#FFF" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 0h24v24H0z" fill="none"/>
                <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
            </svg>
            <span class="ml-2">{{ button_text }}</span>
            <input type='file' class="hidden" @change="handleUploadedFile"/>
        </label>
    </div>
</template>
<script>
    export default {
        props:{
            button_text: {
                required: false,
                default: 'Upload'
            },
            reference: {
                required: true
            }
        },
        data(){
            return {
                file_uploaded: null
            }
        },
        methods: {
            handleUploadedFile(event) {
                this.file_uploaded = event.target.files[0];
                this.$emit('selectFile',{reference: this.reference, file: this.file_uploaded});
            }
        }
    }
</script>
