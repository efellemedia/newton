import './bootstrap';

import Flash from './components/Flash.vue'
import LogoutButton from './components/LogoutButton.vue'
import ExampleComponent from './components/ExampleComponent.vue'

window.app = new Vue({
    el: '#app',

    components: {
        'flash': Flash,
        'logout-button': LogoutButton,
        'example-component': ExampleComponent
    }
});
