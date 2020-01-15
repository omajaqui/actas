
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        listaCompromiso: [ ],
        actividad: '',
        responsable: '',
        date: '',

        //datos para tabla de asistencia
        listaEmpleadosColegio: [
            {nombres:'Alvaro Gutierrez', genero: 'M', cargo:'Docente', cedula: '123456', email:'cualquiera@iesanmiguel.com'},
            {nombres:'Gustavo Perez', genero: 'M', cargo:'Docente', cedula: '56789', email:'gustavo@iesanmiguel.com'},
            {nombres:'Pedro Sanchez', genero: 'M', cargo:'Psicologo', cedula: '987456', email:'pedrin@iesanmiguel.com'},
            {nombres:'Marcela Castro', genero: 'F', cargo:'Rector', cedula: '654321', email:'rectoria@iesanmiguel.com'},
         ],
        listaAsistencia: [],
        nombres: '',
        genero: '',
        cargo: '',
        cedula: '',
    },
    methods: {
        // comprueba que los campos no este vacios e inserta datos en array listaCompromiso[]
        agregarComopromiso: function(){
            if (this.actividad != '' && this.responsable != '' && this.date !== '') {
                this.listaCompromiso.push({actividad:this.actividad, responsable:this.responsable, date:this.date});
                this.actividad = '';
                this.responsable = '';
                this.date = '';
            }else{
                alert('Debe diligenciar todos los campos');
            }
        },

        // Comprueba que los campos no esten vacios
        // recorre array listaEmpleadosColegio[] en busca de clave valor, inserta datos encontrados en array listaAsistencia[]
        agregarAsistencia: function() {            
            if (this.nombres !== '' && this.nombres !== 'NA') {                
                for (i=0 ; i<=this.listaEmpleadosColegio.length ; i++){ 
                    if(this.listaEmpleadosColegio[i]['nombres'] == this.nombres) {                        
                        this.listaAsistencia.push({
                            nombres:this.listaEmpleadosColegio[i]['nombres'],
                            genero:this.listaEmpleadosColegio[i]['genero'],  
                            cargo:this.listaEmpleadosColegio[i]['cargo'],
                            cedula:this.listaEmpleadosColegio[i]['cedula'], 
                            email:this.listaEmpleadosColegio[i]['email'],
                        });
                        this.nombres = '';
                    }
                }                 
            }else{
                alert('Seleccione Empleado para agregar a lista de Asistencia');
                //console.log(this.listaEmpleadosColegio);
            }
        },
        validarForm: function() {
            var txt;
            var r = confirm("Guardar y Enviar confirmacion de Asistencia?");
            if (r == true) {
                //funcion de Guardar y enviar Notificaciond e Asistencia
            } 
        }

    } //cierre de methods  
});//cierre de const app->objet vue

