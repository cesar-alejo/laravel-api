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
        content: '',
        open(data = {}) {
            this.isOpen = true;
            this.title = data.title || '';
            this.content = data.content || '';

            this.fetchData(data.data);
        },
        async fetchData(data) {

            this.$dispatch('start-loading');

            axios.get(data.path, {
                responseType: 'text'
            })
                .then(response => {
                    this.content = response.data;
                })
                .catch(error => {
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