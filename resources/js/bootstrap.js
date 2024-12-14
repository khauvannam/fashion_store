import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

function scrollToId(id) {
    const elementToScroll = document.querySelector(`#${id}`);
    if (elementToScroll) {
        elementToScroll.scrollIntoView({
            behavior: 'smooth', // Smooth scrolling
            block: 'start', // Align the element to the top of the viewport
        });
    }
}

window.scrollToId = scrollToId;


