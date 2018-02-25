import './bootstrap';

import Flash from './components/ExampleComponent.vue'

window.app = new Vue({
    el: '#app',

    components: {
        'example-component': ExampleComponent
    }
});
