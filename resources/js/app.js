import $ from "jquery";
import Swiper from 'swiper';
import {Autoplay, Navigation, Pagination,} from "swiper/modules";
import 'swiper/css';
import "swiper/css/navigation";
import "swiper/css/pagination";

$(() => {
    const swiper = new Swiper(".swiper-cards", {
        modules: [Autoplay, Navigation, Pagination],
        effect: "cards",
        slidesPerView: 4,
        autoplay: {
            delay: 3000,
        },
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
        },
    })
});
