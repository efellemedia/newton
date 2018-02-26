import './bootstrap';

import ExampleComponent from './components/ExampleComponent.vue'

window.app = new Vue({
    el: '#app',

    components: {
        'example-component': ExampleComponent
    }
});
