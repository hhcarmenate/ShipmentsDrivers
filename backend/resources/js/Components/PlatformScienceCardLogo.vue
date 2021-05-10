<template>
    <inertia-link :href="'/'">
        <img
            src="https://images.squarespace-cdn.com/content/5b0db8b875f9ee04cdd6fa3d/1612209109049-2B3V604ZY4EKSE7M3RRC/PS_Logo_Horizontal_Medium_Light.png?content-type=image%2Fpng"
            alt="Platform Science"
            :width="width"
            :height="height"
        >
    </inertia-link>
</template>
<script>
    export default {
        props:{
            width: {
                required: false,
                default: 100
            },
            height: {
                required: false,
                default: 100
            }
        }
    }
</script>
