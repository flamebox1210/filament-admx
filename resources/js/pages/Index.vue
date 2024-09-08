<template>
    <Header/>
    <div class="p-5">
        <div class="bg-white shadow-md rounded-lg p-5 border border-gray-500">
            <h5 class="text-2xl font-medium">Consectetuer porttitor ligula nam turpis malesuada. Auctor taciti nec
                nascetur orci magnis.</h5>
        </div>
    </div>
    <Footer/>
</template>

<script>
import Header from "@/layouts/Header.vue";
import Footer from "@/layouts/Footer.vue";

export default {
    name: 'App',
    components: {Header, Footer}

}
</script>
