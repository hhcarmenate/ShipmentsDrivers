<template>
    <div v-show="showNotification" class="footer-notification text-gray-100 p-4 flex items-center justify-between" :class="notificationStyle">
        <p>
            {{ message }}
        </p>
        <svg
            v-if="!autoClose"
            class="fill-current text-white cursor-pointer"
            xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="18"
            viewBox="0 0 18 18"
            @click="closeNotification"
        >
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
    </div>
</template>
<script>
    export default {
        props:{
            message:{
                required: false,
                default: "Test Notification"
            },
            style: {
                required: false,
                default: 'default'
            },
            autoClose: {
                required: false,
                default: false
            }
        },
        data() {
            return {
                showNotification: true
            }
        },
        methods: {
            closeNotification() {
                this.showNotification = false;
            }
        },
        computed: {
            notificationStyle() {
                switch (this.style){
                    case('success'):
                        return 'bg-green-500';
                    case('error'):
                        return 'bg-red-500';
                    default:
                        return 'bg-gray-500';
                }
            }
        }
    }
</script>
<style>
.footer-notification {
    position: fixed;
    bottom: 0;
    width: 100%;
}
</style>
