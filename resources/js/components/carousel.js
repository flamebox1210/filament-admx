import $ from "jquery";
import Swiper from "swiper";
import {Autoplay, EffectFade, Pagination} from "swiper/modules";
import 'swiper/css';
import "swiper/css/navigation";
import "swiper/css/pagination";

$(() => {
    const swiper = new Swiper(".swiper-carousel", {
        modules: [Autoplay, EffectFade, Pagination],
        effect: "fade",
        slidesPerView: 1,
        autoplay: {
            delay: 3000,
        },
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    })
    swiper.update();
});
