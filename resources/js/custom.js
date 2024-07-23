/**
 * HTML loading in modal rendered on server 
 * 
 * @author Cesar Alejandro Niño <cesaralejo@gmail.com>
 * @version 1.0.0
 * @date 2024-07-18
 * 
 * @param {number} longitud - La longitud del rectángulo.
 * @throws {Error} errors solicitid get
 * 
 * @example
 */
window.modalSubMod = function () {
    return {
        isOpen: false,
        title: 'Title Modal....',
        main: [],
        content: '',
        active: '',
        open(data = {}) {
            this.isOpen = true;
            this.title = data.title || '';
            this.main = data.main || [];
            this.active = data.active || '';

            const dft = this.main.find(link => this.active);
            this.fetchData(dft);
        },
        async fetchData(data) {

            this.active = data.text;
            this.content = 'Cargando....';

            this.$dispatch('start-loading');

            axios.get(data.url, {
                responseType: 'text'
            })
                .then(response => {
                    this.content = response.data;
                })
                .catch(error => {
                    this.content = 'Error | :-(';
                    console.error('Error generado solicitud:', error);
                })
                .finally(() => {
                    this.$dispatch('stop-loading');
                });
        },
        close() {
            this.isOpen = false;
        }
    }
}